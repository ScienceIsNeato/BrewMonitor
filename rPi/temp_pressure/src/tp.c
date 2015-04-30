#include "tp.h"



int set_register(int file, uint8_t addr, uint8_t reg,  uint8_t value)
{
  uint8_t outbuf[2];
  struct i2c_rdwr_ioctl_data packets;
  struct i2c_msg messages[1];  

  messages[0].addr = addr;
  messages[0].flags = 0;  
  messages[0].len = sizeof(outbuf);
  messages[0].buf = outbuf;
  
  outbuf[0] = reg;
  outbuf[1] = value;

  packets.msgs = messages;
  packets.nmsgs = 1;
  
  if(ioctl(file,I2C_RDWR, &packets)< 0){
     openlog("temp_pressure", LOG_PID|LOG_CONS, LOG_USER);
     syslog(LOG_ERR,"unable to send data packet in function set_register");
     return 1;
  }
  return 0;
}


static int get_i2c_register(int file, unsigned char addr, unsigned char reg, unsigned char *value)
{
  unsigned char inbuf, outbuf;
  struct i2c_rdwr_ioctl_data packets;
  struct i2c_msg messages[2];
   
  outbuf = reg;
  messages[0].addr = addr;
  messages[0].flags = 0;
  messages[0].len = sizeof(outbuf);
  messages[0].buf = &outbuf;

  messages[1].addr = addr;
  messages[1].flags = I2C_M_RD;
  messages[1].len = sizeof(inbuf);
  messages[1].buf = &inbuf;
 
  packets.msgs = messages;
  packets.nmsgs = 2;
  
  if(ioctl(file,I2C_RDWR, &packets)<0){
    openlog("temp_pressure", LOG_PID|LOG_CONS, LOG_USER);
    syslog(LOG_ERR,"unable to send packet in get_i2c_register");  
    return 1;  
  } 
  *value=inbuf; 
  return 0;
}



void begin(int file) 
{
   unsigned char value;
   get_i2c_register(file, (unsigned char)MPL3115A2_ADDRESS, (unsigned char)MPL3115A2_WHOAMI, &value);
//   printf("This is value of whomai is %d\n", value);
   if(value !=0xC4)  {
       openlog("temp_pressure", LOG_PID|LOG_CONS,LOG_USER);
       syslog(LOG_WARNING,"whoami value is incorrect");
       return;
   }
   
   unsigned char cval=(unsigned char)(MPL3115A2_CTRL_REG1_SBYB |
	 MPL3115A2_CTRL_REG1_OS128 |
	 MPL3115A2_CTRL_REG1_ALT);
   
//   printf("register MPL3115A2 control register %d\n",cval);
   set_register(file, (unsigned char)MPL3115A2_ADDRESS, (unsigned char)MPL3115A2_CTRL_REG1,cval);
   
   cval=(unsigned char)(MPL3115A2_PT_DATA_CFG_TDEFE | 
         MPL3115A2_PT_DATA_CFG_PDEFE| 
         MPL3115A2_PT_DATA_CFG_DREM);   
 
//   printf("register MPL3115A2 data configuration %d\n",cval);
   set_register(file, (unsigned char)MPL3115A2_ADDRESS, (unsigned char)MPL3115A2_PT_DATA_CFG,cval);
   //initialize the devie
}

void get_current_temp(int file)
{
   unsigned char value=0x00;
   float temp_min, temp_max;
   temp_min=184.0;
   temp_max=56.7+273.15;
   while(! (value & MPL3115A2_REGISTER_STATUS_TDR)){
      get_i2c_register(file,(unsigned char)MPL3115A2_ADDRESS,(unsigned char)MPL3115A2_REGISTER_STATUS, &value);
      usleep(10000);
   //   printf("status has value %d\n",value);
   }
   uint16_t temp;
   unsigned char t_msb;
   get_i2c_register(file,(unsigned char)MPL3115A2_ADDRESS,(unsigned char)MPL3115A2_REGISTER_TEMP_MSB, &t_msb);
  
   unsigned char t_lsb;
   get_i2c_register(file,(unsigned char)MPL3115A2_ADDRESS,(unsigned char)MPL3115A2_REGISTER_TEMP_LSB, &t_lsb);
   
//   printf("the temperature is %d %d\n", t_lsb,  t_msb);  
   temp=t_msb;
//   printf("temp = %d\n",temp);
   temp=t_msb<<4;
//   printf("temp = %d\n",temp);
   t_lsb=t_lsb>>4;
   temp=temp | t_lsb;
//   printf("temp = %d\n",temp);
   float tmp=(float)temp;
   tmp=tmp/16.0+273.15;
   if(temp_min<tmp && tmp<temp_max){
      printf("temperature=%g \n", tmp);   
   }else{
      openlog("temp_pressure", LOG_PID|LOG_CONS, LOG_USER);
      syslog(LOG_ERR, "invalid temperature reading from the MPL3115A2");
   }
}


void get_current_pressure(int file)
{
   unsigned char value;
   float pressure_max,pressure_min;
   pressure_max=108500.0;
   pressure_min=87000.0;
   value=(unsigned char)(MPL3115A2_CTRL_REG1_SBYB |
                        MPL3115A2_CTRL_REG1_OS128 | MPL3115A2_CTRL_REG1_BAR);
   set_register(file,(unsigned char)MPL3115A2_ADDRESS,(unsigned char)MPL3115A2_CTRL_REG1,value);

   value = 0x00;
   while( !(value & MPL3115A2_REGISTER_STATUS_PDR)){
     get_i2c_register(file,(unsigned char)MPL3115A2_ADDRESS,(unsigned char)MPL3115A2_REGISTER_STATUS, &value);
     usleep(10000);
 //    printf("status has value %d\n",value);
   } 
   int p;
   float pressure;
   unsigned char p_msb,p_csb,p_lsb;
   get_i2c_register(file,(unsigned char)MPL3115A2_ADDRESS,(unsigned char)MPL3115A2_REGISTER_PRESSURE_MSB,&p_msb);
   get_i2c_register(file,(unsigned char)MPL3115A2_ADDRESS,(unsigned char)MPL3115A2_REGISTER_PRESSURE_CSB,&p_csb);
   get_i2c_register(file,(unsigned char)MPL3115A2_ADDRESS,(unsigned char)MPL3115A2_REGISTER_PRESSURE_LSB,&p_lsb);
   p=p_msb;
   p=p<<8;
   p=p | p_csb;
   p=p<<8;
   p=p | p_lsb;
   p=p>>4;
   pressure=(float)p;
   pressure=pressure*0.25E0;
   if(pressure_min < pressure && pressure < pressure_max){
      printf("pressure=%g\n",pressure);
   }else{
      openlog("temp_pressure", LOG_PID|LOG_CONS, LOG_USER);
      syslog(LOG_ERR, "invalid pressure reading from the MPL3115A2");
   }
}   

   


  
