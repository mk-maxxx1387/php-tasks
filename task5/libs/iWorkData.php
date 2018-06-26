<?php

interface iWorkData {
    public function saveData($key, $val);
    public function getData($key);
    public function deleteData($key);
}
