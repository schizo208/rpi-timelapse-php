#!/usr/bin/python

"""
    tl_capture.py

    Main python script to issue periodic capture of images for a timelapse video.
"""

__author__      = "Tyson Lewis"
__copyright__   = "2015"
__license__     = "GPL v2"
__link__        = "https://github.com/schizo208/rpi-timelapse-php"

import csv
import sys
import os
import time
from datetime import datetime, timedelta

opts={}
for cfg in csv.reader(open(sys.argv[1],'r')):
    opts[cfg[0]]=cfg[1]

t_end=datetime.now() + timedelta(hours=float(opts.get("duration","2")))
t_int=float(opts.get("interval","10"))

while (datetime.now() < t_end):
    t_next=datetime.now() + timedelta(seconds=t_int)
    cam_command="raspistill {0} {1} -o tl_img_{2}.jpg".format(opts.get("cl_args",""),opts.get("sz_args","-w 1920 -h 1080"),datetime.now().isoformat().replace(":",'.'))
    os.system(cam_command)
    while datetime.now() < t_next: t_next = t_next
