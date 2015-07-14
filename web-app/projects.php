<?
/**
 * projects.php
 *
 * This file is the main landing page for the timelapse
 * project manager. The project settings or start/stop
 * console can be launched from here.
 *
 * @author      Tyson Lewis
 * @copyright   2015 Tyson Lewis
 * @link        https://github.com/schizo208/rpi-timelapse-php
 */
    include "common.php";
    if ($_GET["action"] == "shutdown") pi_shutdown(); 
    if ($proj = tl_running()) {
        //header("Location: project_control.php?project=".$proj);
    }
?>

<? page_header(); ?>

    <div data-role="header" data-position="fixed">
	<h2>Projects</h2>
    </div>

    <div data-role="content" align="center">
        <h2>Projects</h2>
        <?
            exec("find /home/pi/timelapse | grep '\\.proj' | egrep -o '[^/]+\.[^/]+' | cut -d'.' -f1",$projects);
            foreach ($projects as $project) {
        ?>
        <h3>
            <? echo $project; ?>
            <a class="ui-btn ui-btn-inline" href="project_control.php?project=<? echo $project; ?>">Console</a> 
            <a class="ui-btn ui-btn-inline" href="project.php?project=<? echo $project; ?>">Edit Settings</a>
        </h3>
        <?
            }
        ?>
    </div>

    <div data-role="footer" data-position="fixed">
        <a href="projects.php?action=shutdown" data-icon="power">Shutdown</a>
        <a href="project.php" data-icon="plus" class="ui-btn-right">New Project</a>
    </div>

<? page_footer(); ?>
