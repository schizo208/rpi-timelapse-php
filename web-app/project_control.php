<?
/**
 * project_control.php
 *
 * This file renders a GUI to stop or start image acquistion
 * for an existing timelapse project. It kicks off the tl_capture.sh
 * script to start the tl_capture.py daemon.
 *
 * @author      Tyson Lewis
 * @copyright   2015 Tyson Lewis
 * @link        https://github.com/schizo208/rpi-timelapse-php
 */
include "common.php";
if ($proj = $_POST["project"]) {
    if ($_POST["target_action"] == "start") {
        exec("date -s '" . $_POST["time"]. "'",$lines);
        start_tl($proj);
    }
    elseif ($_POST["target_action"] == "stop") stop_tl();
}
else {
    $proj = $_GET["project"];
}
if ($proj == tl_running()) {
    exec("find " . $tl_path . "/" . $proj . "/ -newer " . $pid_path . " | wc -l",$lines);
    foreach($lines as $line) {
        $no_taken = $line;
    }
    $running = True;
}
?>

<? page_header(); ?>

    <div data-role="header">
        <a href="projects.php" data-icon="home">Home</a>
        <h2>Project <? echo $proj ?></h2>
    </div>

    <div data-role="content" align="center">
        <h3>Camera Status:</h3>
        <h4><? echo $running ? "<font color='green'>Running</font>" : "<font color='red'>Stopped</font>" ?></h4>
        <? echo $running ? $no_taken . " pictures taken since last start.<br/>" : "" ?><br/>
        <form name="pformcontrol" id="pformcontrol" action="project_control.php" method="post">
        <input type="hidden" name="project" id="project" value="<? echo $proj ?>">
        <input type="hidden" name="target_action" id="target_action" value="">
        <input type="hidden" name="time" id="time" value="">
        </form>
    </div>

    <div data-role="footer" data-position="fixed">
        <a href="#" onclick="fSubmitControl(2);" data-icon="delete">Stop Camera</a>
        <a href="#" onclick="fSubmitControl(1);" data-icon="video" data-theme="b" class="ui-btn-right">Start Camera</a>
    </div>

<? page_footer(); ?>
