#!/bin/python
import subprocess
import time
import os
import logging
import sqlite3
import re
import sys

volume=1
R=8.3144621
log_FILENAME="/var/log/beer_service.log"
logging.basicConfig(format='%(asctime)s %(message)s', datefmt='%m/%d/%Y %I:%M:%S %p', level=logging.DEBUG)#,filename=log_FILENAME)
from operator import itemgetter
TEMP_PATH="/tmp/tp.status"

DATA_DIR="/var/data"

def getkey(item):
    return item[1]
    
def check_run_status():
   creation_times=[]
   logging.info("checking run histories")
   for root, dirs, files in os.walk(DATA_DIR):
      for dirname in dirs:
         current_dir=root+"/"+dirname
         status_file=current_dir+"/status"
         seconds=time.ctime(os.path.getmtime(current_dir)) 
         history=[]
         if os.path.isfile(status_file):
            fh=open(current_dir+'/status','r')
            for  line in fh:
               history.append(line)
         else:
            logging.warning("did not find status file "+status_file)
         creation_times.append([seconds,current_dir,history])
   creation_times.sort(key=itemgetter(0),reverse=True)
   fh.close()
       
        
def create_new_run(run_name, description):
   path=DATA_DIR+"/"+run_name
   if(os.path.isdir(path) == False):
      os.mkdir(path, 0755)
   else:
      logging.error("the run name must be unique")
      exit();
   os.chdir(path)
   #---------------------create status file---------------------------------------------------
   fh = open(path+"/status", "w")
   creation_time=time.ctime(time.time())
   fh.write("Created on {!s}".format(creation_time))
   fh.close()
   #--------------------write brew description file-------------------------------------------
   gh=open(path+"/description","w")
   gh.write("{!s}".format(description))
   gh.close()
   #- ----------------create database with tables--------------------------------------------#
   try:
      db=sqlite3.connect(run_name+".sqlite3")
      cursor=db.cursor()
      sql_raw='''CREATE TABLE IF NOT EXISTS raw_data (
                   id INTEGER PRIMARY KEY, 
                   dt datetime default current_timestep,  
                   temperature float,
                   pressure float,
                   moles float
                   )'''
      cursor.execute(sql_raw)
      db.commit()
      sql_cycle ='''CREATE TABLE IF NOT EXISTS cycles (
                    id INTEGER PRIMARY KEY,
                    dt datetime default current_timestep,
                    start_pressure float,
                    end_pressure float,
                    start_temp float,
                    end_temp float,
                    CO2_moles float
                    )'''
   
      cursor.execute(sql_cycle)
      db.commit()
#-----------------------------------------------------------------------------------------------#                 
   except Exception as e:
      logging.exception("could not create databases for "+ run_name + "with exception ")
   return (path,db)


def write_raw_data( db,temp, pres, moles):
   sql="INSERT INTO raw_data (dt, temperature, pressure, moles) VALUES(datetime('now'), {:f}, {:f}, {:f})".format(temp,pres,moles)
   try:
      cursor=db.cursor()
      cursor.execute(sql)
      db.commit()
   except Exception as e:
      logging.exception("could not write to the raw data table with exception ")


def write_cycle_data(db, pi,pf, ti, tf):
   CO2_moles= volume/R*(pf/tf-pi/ti)
   sql='''INSERT INTO cycles (dt,start_press, end_press,start_temp,end_temp,CO2_moles)
       VALUES(datetime('now'), {:f}, {:f}, {:f}, {:f}, {:f})'''.format(pi,pf,ti,tf,CO2_moles)
   try:
      cursor=db.cursor()
      cursor.execute(sql)
      db.commit()
   except Exception as e:
      logging.exception("could not write to cycles table with exception ")
 
   
def get_temp_and_pressure():
    pattern=re.compile(r"\d+\.?\d{0,4}")
    cmd = ['cat', TEMP_PATH ]
    p = subprocess.Popen(cmd, stdout=subprocess.PIPE,
                              stderr=subprocess.PIPE,
                              stdin=subprocess.PIPE)
    line,err=p.communicate()
    data=pattern.findall(line)
    print data
    return data


def start_service(db,path,interval,duration, percent=10): 
    os.chdir(path)
    fhs=open(path+"/status","a")
    data=[]
    start_t=0
    start_p=0
    t=0
    p=0
    start_time=time.time()
    fhs.write("run started on {!s}".format(time.ctime(start_time)))
    end_time = start_time + duration*24*3600
    retry=True
    while(retry):
       data=get_temp_and_pressure()
       if(len(data) == 2):
          start_t=float(data[0])
          start_p=float(data[1])
          if( start_t > 0 and start_p > 0):
             end_p=start_p*(1+percent/100.0)
             moles=start_p*volume/(R*start_t)
             write_raw_data(db, start_t, start_p, moles )
             retry=False
          else:
             logging.warning("invalid temperature or pressure value")
             sleep(interval)
             continue
       else:
          logging.warning("failed to read both temperature and pressure on start")
          sleep(interval)
          continue

    current_time=time.time()    
   
    while(current_time < end_time):
       time.sleep(interval)
       data=get_temp_and_pressure()
       if(len(data) == 2):
          t=float(data[0])
          p=float(data[1])
       else:
          logging.warning("failed to read both temperature and pressure")
        
       while(p < end_p):
          if(len(data) == 2 ):
             t=float(data[0])
             p=float(data[1])
             
             if( t > 0 and p > 0):
                moles=p*volume/(R*t)     
                write_raw_data(db,t,p,moles)
             else:
                logging.warning("failed to read both temperature and pressure")
                continue
          else:
             logging.warning("invalid temperature or pressure value")
             continue
              
          time.sleep(interval)
          data=get_temp_and_pressure()
          current_time=time.time()
          if( current_time > end_time):
             break;
           
       fhs.write("cycled on {!s}".format(time.ctime(time.time())))     
       write_cycle_data(db, start_p,p,start_t,t)
        
       data=get_temp_and_pressure()
       if(len(data) == 2):
          start_t=float(data[0])
          start_p=float(data[1])
          if (start_t<0 and start_p<0):
             moles=start_p*volume/(R*start_t)
             write_raw_data(db,start_t,start_p,moles) 
          else:
             logging.warning("invalid temperature or pressure value")
             continue
       else:
          logging.warning("failed to read both temperature and pressure")
          continue

       current_time=time.time() 
    fhs.write("finished run on {!s}".format(time.ctime(time.time())))
    fhs.close()
   
if __name__ == "__main__":
   path,dbh=create_new_run("test8","this is test of our system")
   start_service(dbh,path,10,1)





































