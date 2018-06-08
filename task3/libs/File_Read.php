<?php

class File_Read {
    private $filePath;
    private $fileContent;
    private $sngl;

    public function __construct($filePath, $sngl){
        $this->filePath = $filePath;
        $this->sngl = $sngl;
        $this->getFileContent();
    }

    public function getFileContent(){
        if(!is_readable($this->filePath)){
            $sngl->isError = true;
            $sngl->msg = ERR_1;
            return;
        }

        $this->fileContent = file($this->filePath);
    }

    public function getStrByIndex($index){
        $fcontent = $this->fileContent;
        if(array_key_exists(($index-1), $fcontent)){
            return $fcontent[$index-1];
        }
        $sngl->isError = true;
        $sngl->msg = ERR_2.count($fcontent);
        return;
    }

    public function getCharByIndex($strIndex, $index){
        $str = $this->getStrByIndex($strIndex);
        $char = $str{$index-1};
        if(isset($char)){
            return $char;
        }
        $sngl->isError = true;
        $sngl->msg = ERR_3.strlen($str);
        return;
    }

    public function replaceStr($strIndex, $newStr){
        $fcontent = $this->fileContent;
        if(array_key_exists($strIndex-1, $fcontent)){
            if(!(substr($newStr, -1) == "\n")){
                $newStr .= "\n";
            }
            $fcontent[$strIndex-1] = $newStr;
            $this->fileContent = $fcontent;
            return $this->getStrByIndex($strIndex);
        }
        $sngl->isError = true;
        $sngl->msg = ERR_2.count($fcontent);
        return;
    }

    public function replaceChar($strIndex, $charIndex, $newChar){
        $str = $this->getStrByIndex($strIndex);
        if($charIdex < strlen($str) && $charIndex > 0){
            $str{$charIndex-1} = $newChar;
        }

        return $this->replaceStr($strIndex, $str);
    }

    public function saveFile(){
        if(is_writable){
            file_put_contents(FILE_PATH, $this->fileContent);
            return true;
        }
        $sngl->isError = true;
        $sngl->msg = ERR_1;
        return false;
    }
}
