<?php
include ('config.php');
spl_autoload_register(function ($class) {
    include 'libs/' . $class . '.php';
});
try
{
  $obj = new Controller();
}
catch(Exception $e)
{
  echo $e->getMessage();	           
}






