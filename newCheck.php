<?php 
require 'vendor/autoload.php';
$obj = new Tasks();
$newObj = $obj->items();
echo $newObj[0]['COUNT(checked)'];
