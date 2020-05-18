<?php
require 'vendor/autoload.php';

$obj = new Tasks();

if(isset($_POST['id']) && isset($_POST['task']))
{
    $id = $_POST['id'];
    $task = $_POST['task'];
    $obj->editTask($id, $task);
}

