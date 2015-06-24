#!/bin/python
import beer_service as bs


data=bs.check_run_status()

for x in data:
   print x
  
