#!/bin/python

#This code uses pin 4 
import time
try:
    import RPi.GPIO as GPIO
except RuntimeError:
    print("Error importing RPi.GPIO!  This is probably because you need superuser privileges.  You can achieve this by using 'sudo' to run your script")

outlet_valve_pin=7

def initialize_valves():
   GPIO.setwarnings(False)
   GPIO.setmode(GPIO.BOARD)
   GPIO.setup(outlet_valve_pin, GPIO.OUT, initial=GPIO.LOW)

def open_outlet_valve():
   GPIO.output(outlet_valve_pin,1)
   
def close_outlet_valve():
   GPIO.output(outlet_valve_pin,0)

  
if __name__ == "__main__":
   initialize_valves()
   while(True):
      open_outlet_valve()
      time.sleep(3)
      close_outlet_valve()
      time.sleep(3)
  


   
