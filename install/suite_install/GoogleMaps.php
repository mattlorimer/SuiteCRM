<?php
function install_gmaps()
{
    require_once('ModuleInstall/ModuleInstaller.php');
    $ModuleInstaller = new ModuleInstaller();
    $ModuleInstaller->install_custom_fields(getCustomFields());
}

function getCustomFields()
{
    $custom_fields = array();
    return $custom_fields;
}
