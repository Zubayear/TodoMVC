<?php 
// require 'vendor/autoload.php';
// use Todolist\Dbh;
// use Todolist\Tasks;
include 'Class/Dbh.php';
include 'Class/Tasks.php';
$obj = new Tasks();
$newObj = $obj->items();
echo $newObj[0]['COUNT(checked)'];
