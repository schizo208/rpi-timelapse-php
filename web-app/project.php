<? 
/**
 * project.php
 *
 * This file renders GUI and handles configuration for existing and
 * new timelapse projects.
 *
 * @author      Tyson Lewis
 * @copyright   2015 Tyson Lewis
 * @link        https://github.com/schizo208/rpi-timelapse-php
 */
    include "common.php";
    if ($_POST["save"] == "save") {
        $proj = $_POST["name"];
        $proj_path = $tl_path . "/" . $proj;
        $proj_file = $proj_path . "/" . $proj . ".proj";
        system("mkdir " . $proj_path);
        $file = fopen($proj_file,"w");
        fputs($file,"prj_name,".$_POST["name"].    "\n");
        fputs($file,"interval,".$_POST["interval"]."\n");
        fputs($file,"duration,".$_POST["duration"]."\n");
        fputs($file,"cl_args,". $_POST["cl_args"] ."\n");
        if ($_POST["sz_args"] == "custom")
            fputs($file,"sz_args,-w ".$_POST["width"]." -h ".$_POST["height"]);
        else
            fputs($file,"sz_args,".$_POST["sz_args"]);
        fclose($file);
    }
    if ($_GET["project"] <> "") $proj = $_GET["project"];
    if ($proj) {
        $proj_path = $tl_path . "/" . $proj;
        $proj_file = $proj_path . "/" . $proj . ".proj";
        $file = fopen($proj_file,"r");
        while ($line = fgets($file)) {
            $parts = explode(",",$line);
            if ($parts[0] == "cl_args") $cl_args = $parts[1];
            if ($parts[0] == "sz_args") $sz_args = $parts[1];
            if ($parts[0] == "prj_name") $proj_name = $parts[1];
            if ($parts[0] == "interval") $interval = $parts[1];
            if ($parts[0] == "duration") $duration = $parts[1];
        }
        fclose($file);
    }
 ?>

<? page_header(); ?>

    <div data-role="header" data-position="fixed">
        <a href="projects.php" data-icon="home">Home</a>
        <h2>Project Settings</h2>
    </div>

    <div data-role="content">
        <form id="pformsettings" name="pformsettings" method="post" action="" target="_blank">
            <fieldset class="ui-field-contain">
                <label for="name">Project Name:</label>
                <input type="text" id="name" name="name" value="<? echo $proj_name; ?>">
            </fieldset>
            <fieldset class="ui-field-contain">
                <label for="interval">Interval (Seconds between pictures):</label>
                <input type="text" name="interval" id="interval" value="<? echo $interval ? $interval : "10"?>">
                <label for="duration">Duration (Hours to take pictures):</label>
                <input type="text" name="duration" id="duration" value="<? echo $duration ? $duration : "2"?>">
            </fieldset>
        <?  if ($sz_args) echo "<input type='hidden' id='sz_args' name='sz_args' value='" . $sz_args . "'>";
            else {
        ?>
	    <fieldset class="ui-field-contain">
                <label for="sz_args">Resolution:</label>
                <select name="sz_args" id="sz_args" onchange="tgDiv()">
                    <option value="-w 1920 -h 1080">Full HD (1080p)</option>
                    <option value="-w 1280 -h 720">HD (720p)</option>
                    <option value="-w 720 -h 480">DVD (480p)</option>
                    <option value="custom">Custom</option>
                </select>
            </fieldset>
            <fieldset class="ui-field-contain" id="resdiv" name="resdiv" style="display:none;">
                <label for="width">Width:</label>
                <input name="width" id="width" type="text">
                <label for="height">Height:</label>
                <input name="height" id="height" type="text">
            </fieldset>
        <?  }  ?>
            <fieldset class="ui-field-contain">
                <label for="cl_args">Ext. Args:</label>
                <input type="text" id="cl_args" name="cl_args" value="<? echo $cl_args; ?>">
            </fieldset>
            <input type="hidden" name="save" id="save" value="save">
	</form>
    </div>

    <div data-role="footer" data-position="fixed">
        <a href="#" onclick="fSubmitSettings(1);" data-icon="eye">Test Picture</a>
        <a href="#" onclick="fSubmitSettings(2);" data-icon="check" data-theme="b" class="ui-btn-right">Save</a>
    </div>

<? page_footer(); ?>
