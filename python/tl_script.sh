#!/bin/bash

# tl_script.sh
#
# Script to kick off python script tl_capture.py in background.
# Disconnects script from stdin and stdout for use as daemon.
#
# Author: Tyson Lewis
# Copyright: 2015
# License: GPL v2
# Link: https://github.com/schizo208/rpi-timelapse-php

directory=`dirname $0`
cd `dirname $1`
$directory/tl_capture.py $1 < /dev/null > /dev/null &

mypid=$!
cd $directory
echo $mypid > tl_capture.pid
