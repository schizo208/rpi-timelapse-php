/**
 * form-actions.js
 *
 * This file contains all the javascript code to facilitate
 * different form actions among the various project pages.
 *
 * @author      Tyson Lewis
 * @copyright   2015 Tyson Lewis
 * @link        https://github.com/schizo208/rpi-timelapse-php
 */
function tgDiv() {
    var tdiv = document.getElementById("resdiv");
    var size = document.getElementById("sz_args");
    if (size.value == "custom") tdiv.style.display = "block";
    else tdiv.style.display = "none";
}
function fSubmitSettings(action) {
    var pform = document.getElementById("pformsettings"); 
    if (action == 1) {
        pform.action = "testpic.php";
        pform.target = "_blank";
        pform.submit();
    } else {
        pform.action = "project.php";
        pform.target = "";
        pform.submit();
    }
}
function fSubmitControl(action) {
    var pform = document.getElementById("pformcontrol"); 
    var target_action = document.getElementById("target_action");
    var time_field = document.getElementById("time");
    if (action == 1) {
        target_action.value = "start";
        time_field.value = (new Date()).toISOString();
        pform.submit();
    } else {
        target_action.value = "stop";
        pform.submit();
    }
}
