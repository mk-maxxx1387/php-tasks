<?php

include('config/config.php');
include(FUNCTIONS_PATH);
include_once('libs/Singleton.php');

$action = $_REQUEST['action'];
$title = 'Main page';
$message = array();
$files = array();
$sngl = Singleton::getInstance();

//var_dump($_REQUEST);
if(!$action){
    $action = 'main';
}
switch($action){
    case 'delete':
        $fileName = $_REQUEST['filename'];
        deleteFile($fileName, $sngl);
        break;
    case 'uploadFile':
        uploadFile($sngl);
        break;
    case 'main':
    default:
        $sngl->isError = false;
        $sngl->message = '';
    break;
}

$message = array(
    'isError' => $sngl->isError,
    'msg' => $sngl->message
);

$files = getFiles($sngl);

include(TPL_PATH.'index.php');
