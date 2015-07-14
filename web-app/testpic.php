<?
/**
 * testpic.php
 *
 * This file kicks off an image capture from the project settings
 * page (project.php) and returns that image to the user. This allows
 * the user to confirm the correct settings (brightness, width, etc.)
 * are set for the desired result.
 *
 * @author      Tyson Lewis
 * @copyright   2015 Tyson Lewis
 * @link        https://github.com/schizo208/rpi-timelapse-php
 */
$cl_args = "";
if ($_POST["sz_args"] == "custom") {
    $cl_args = "-w " . $_POST["width"] . " -h " . $_POST["height"];
} else {
    $cl_args = $_POST["sz_args"];
}
$cl_args = $cl_args . " " . $_POST["cl_args"];
if ($_POST["cl_args"] != "") $cl_args = $cl_args . " " . $_POST["cl_args"];
system("raspistill " . $cl_args . " -o /var/www/test.jpg");
//var_dump($_GET);
//var_dump($_POST);
?>
<img src="test.jpg">
