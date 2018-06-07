<?php

function uploadFile($sngl){ 
    if(!is_dir(UPLOAD_DIR)){
        mkdir(UPLOAD_DIR, 0777);
    }

    $file = UPLOAD_DIR.basename($_FILES['fileUpload']['name']);
    $fileTmp = $_FILES['fileUpload']['tmp_name'];

    $file = fileExist($file);
    if(is_writable(UPLOAD_DIR)){
        move_uploaded_file($fileTmp, $file);
        $sngl->isError = false;
        $sngl->message =  MSG_1;
    } else{
        $sngl->isError = true;
        $sngl->message = ERR_1;
    }
    return;
}

function getFiles($sngl){
    $result = array();
    if(!is_readable(UPLOAD_DIR)){
        $sngl->isError = true;
        $sngl->message = ERR_3;
        return;
    }
    $dir_files = scandir(UPLOAD_DIR, 1);

    foreach($dir_files as $key=>$file_name){
        if($file_name == '.' 
            || $file_name == '..' 
            || !is_readable(UPLOAD_DIR."$file_name")
        ) continue;

        $file_size = round(filesize(UPLOAD_DIR.$file_name)/1024, 2);
        $result[$key+1] = array('name'=>$file_name, 'size'=>$file_size);
    }

    return $result;
}

function fileExist($file){
    $res = $file;
    if(!file_exists($res)){
         return $res;
    }

    $fileName = pathinfo($file, PATHINFO_FILENAME);
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $i = 1;
    while(file_exists(UPLOAD_DIR."$fileName ($i).$ext")){
         $i++;
    }
    return (UPLOAD_DIR."$fileName ($i).$ext");
}

function deleteFile($file_name, $sngl){
    $file = UPLOAD_DIR.$file_name;
    if(is_writable($file)){
        unlink($file);
        $sngl->isError = false;
        $sngl->message = MSG_2;
    } else {
        $sngl->isError = true;
        $sngl->message = ERR_2;
    }
    return;
}


