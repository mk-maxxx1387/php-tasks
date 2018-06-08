<?php
include_once('config/config.php');
include_once(LIB_PATH.'Singleton.php');
include_once(LIB_PATH.'File_Read.php');

$sngl = Singleton::getInstance();

$obj = new File_Read(FILE_PATH, $sngl);
$inp_file = $obj->printFile();
$str = $obj->getStrByIndex(5);
$char = $obj->getCharByIndex(3, 1);
$newStr = $obj->replaceStr(4, 'sseesse');
$newCharStr = $obj->replaceChar(3, 1, 'Z');
$obj->saveFile();
$out_file = $obj->printFile();
include('templates/index.php');

