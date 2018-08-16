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

    public function printFile(){
        if(is_readable(FILE_PATH)){
            $file = "";
            $i = 1;
            foreach($this->fileContent as $line){
                $file .= "$i)$line<br>";
                $i++;
            }
            return $file;

        }
        $this->sngl->isError = true;
        $this->sngl->msg = ERR_1;
        return false;
    }

    public function getFileContent(){
        if(!is_readable($this->filePath)){
            $this->sngl->isError = true;
            $this->sngl->msg = ERR_1;
            return;
        }

        $this->fileContent = file($this->filePath);
        return $this->fileContent;
    }

    public function getStrByIndex($index){
        $fcontent = $this->fileContent;
        if(array_key_exists(($index-1), $fcontent)){
            return $fcontent[$index-1];
        }
        $this->sngl->isError = true;
        $this->sngl->msg = ERR_2.count($fcontent);
        return;
    }

    public function getCharByIndex($strIndex, $index){
        $str = $this->getStrByIndex($strIndex);
        $char = $str{$index-1};
        if(isset($char)){
            return $char;
        }
        $this->sngl->isError = true;
        $this->sngl->msg = ERR_3.strlen($str);
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
        $this->sngl->isError = true;
        $this->sngl->msg = ERR_2.count($fcontent);
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
        if(is_writable(FILE_PATH) && is_readable(FILE_PATH))
		{
            file_put_contents(FILE_PATH, $this->fileContent);
            return true;
        }
		
        $this->sngl->isError = true;
        $this->sngl->msg = ERR_1;
        return false;
    }
}
