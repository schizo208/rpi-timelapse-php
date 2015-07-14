<?
/**
 * common.php
 *
 * This file contains common code for the RPi timelapse program.
 *
 * @author      Tyson Lewis
 * @copyright   2015 Tyson Lewis
 * @link        https://github.com/schizo208/rpi-timelapse-php
 */

$tl_path="/home/pi/timelapse";
$script_path=$tl_path . "/tl_script.sh";
$pid_path=$tl_path . "/tl_capture.pid";
function start_tl($proj) {
    global $tl_path, $script_path, $pid_path;
    system("start-stop-daemon -p " . $pid_path . " -a " . $script_path . " --start -- " . $tl_path . "/" . $proj . "/" . $proj . ".proj");
}
function stop_tl() {
    global $tl_path, $script_path, $pid_path;
    system("start-stop-daemon -K -p " . $pid_path);
}
function pi_shutdown() {
    system("sudo shutdown -h now",$ret_val);
    echo $ret_val;
}
function tl_running() {
    exec("ps aux | grep tl | egrep -o '[^/]+\.proj' | cut -d'.' -f1",$lines);
    //echo("ps aux | grep tl | egrep -o '[^/]+\.proj' | cut -d'.' -f1" . "\n");
    foreach($lines as $line) {
            //echo $line . "\n";
            if (strpos($line,"]"));
            else return $line;
    }
}
function page_header() {
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="jquery/jquery.mobile-1.4.5.min.css"/>
    <script src="jquery/jquery-1.11.3.min.js"></script>
    <script src="jquery/jquery.mobile-1.4.5.min.js"></script>
    <script src="form_actions.js"></script>
</head>
<body>
<div data-role="page">
<?
}
function page_footer() {
?>
</div>
</body>
</html>
<?
}
?>
