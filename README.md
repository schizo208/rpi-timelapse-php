# rpi-timelapse-php
A PHP web interface for capturing timelapse frames.

How to use project:
1. Copy web-app directory to /var/www or web application
   directory.
2. Copy python directory to storage location for
   timelapse projects and photos.
3. Change tl_path in web-app/common.php to refer to
   location in (2).

Notes:
+ Web user (e.g www-data) needs to have write/execute 
  permission on /dev/vchiq to execute raspistill.
+ Web user needs to have write/execute permission on 
  python directory to start timelapse daemon.

