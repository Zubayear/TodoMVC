<?php
// require 'vendor/autoload.php';
// use Todolist\Dbh;
// use Todolist\Tasks;
include 'Class/Dbh.php';
include 'Class/Tasks.php';
$obj = new Tasks();

if(isset($_POST['id']) && isset($_POST['task']))
{
    $id = $_POST['id'];
    $task = $_POST['task'];
    $obj->editTask($id, $task);
}

