<?php

include('config/config.php');
include(FUNCTIONS_PATH);

$action = $_REQUEST['action'];
$title = 'Main page';
$message = array();
$files = array();

//var_dump($_REQUEST);
if(!$action){
    $action = 'main';
}

switch($action){
    case 'delete':
        $fileName = $_REQUEST['filename'];
        $message = deleteFile($fileName);
        $files = getFiles();
        break;
    case 'uploadFile':
        $message = uploadFile();
        $files = getFiles();
        break;
    case 'main':
    default:
        $files = getFiles();
    break;
}

include(TPL_PATH.'index.php');
