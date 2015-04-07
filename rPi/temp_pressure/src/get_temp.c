/*#include <stdint.h>
#include <linux/i2c-dev.h>
#include <sys/ioctl.h>
#include <stdio.h>
#include <stdlib.h>
#include <fcntl.h>
#include <unistd.h>
#include <linux/i2c.h>*/
#include "tp.h"


 
int main(int argc, char** argv)
{
  int c;
  int FH;
  FH=open("/dev/i2c-1",O_RDWR);
  begin(FH);
  get_current_temp(FH);
  begin(FH);
  get_current_pressure(FH);
/*  while((c=getopt(argc,argv,"tpTPh"))!=-1)
  {
    printf("selected option %s\n",c);
    switch (c)
    {
    case 't':
      begin(FH);
      get_current_temp(FH);
      
    case 'T':
      begin(FH);
      get_current_temp(FH);
     
    case 'p':
      begin(FH);
      get_current_pressure(FH);
      
    case 'P':
      begin(FH);
      get_current_pressure(FH);
  
    case 'h':
      printf("%s", "To get the pressure use p, to get the temperature  us t");
      return 0;
    default:
      printf("%s", "To get the pressure use p, to get the temperature us t");
    }
  }*/
  close(FH);
  return 0;
}
