#!/bin/bash

chmod 666 /sys/module/i2c_bcm2708/parameters/combined;
 echo -n 1 > /sys/module/i2c_bcm2708/parameters/combined
