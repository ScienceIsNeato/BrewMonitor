#!/bin/sh




while ( true )
   do 
   tp=`temp_pressure`
   temperature=`echo $tp | grep temp`
   [ -n "$tp" ] && [ -z "$temperature" ] && logger "iteration did not produce a temperature"
   [ -n "$temperature" ] &&  echo "$temperature" > "/tmp/tp.status"
   sleep 1
done





