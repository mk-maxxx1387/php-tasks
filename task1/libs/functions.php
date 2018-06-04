<?php

function uploadFile(){ 
    if(!is_dir(UPLOAD_DIR)){
        mkdir(UPLOAD_DIR, 0777);
    }

    $file = UPLOAD_DIR.basename($_FILES['fileUpload']['name']);
    $fileTmp = $_FILES['fileUpload']['tmp_name'];

    if(move_uploaded_file($fileTmp, $file)){ 
        return getMessage(false, MSG_1);
    } else {
        return getMessage(true, ERR_1);
    }    
}

function getFiles(){
    $result = array();
    $dir_files = scandir(UPLOAD_DIR, 1);

    foreach($dir_files as $key=>$file_name){
        if($file_name == '.' || $file_name == '..') continue;

        $file_size = round(filesize(UPLOAD_DIR.$file_name)/1024, 2);
        $result[$key+1] = array('name'=>$file_name, 'size'=>$file_size);
    }

    return $result;
}

function fileExist($file){
    if(file_exist($file)){
        
    } else {
        return $file;
    }
}

function deleteFile($file_name){
    $file = UPLOAD_DIR.$file_name;
    if(is_writable($file)){
        unlink($file);
        return getMessage(false, MSG_2);
    } else {
        return getMessage(true, ERR_2);
    }
}

function getMessage($isError, $message){
    return array(
       'isError' => $isError,
       'message' => $message
   );
}

function checkPermission($file_name){
}

