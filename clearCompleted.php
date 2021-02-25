
<?php

require 'vendor/autoload.php';
$obj = new Tasks();
$obj->clearCompleted(); 
echo $obj->number();
