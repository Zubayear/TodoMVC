<?php
// require 'vendor/autoload.php';
// use Todolist\Dbh;
// use Todolist\Tasks;
include 'Class/Dbh.php';
include 'Class/Tasks.php';
$obj = new Tasks();
if(isset($_POST['id']))
{
    $id = $_POST['id'];

    if(empty($id))
    {
        echo 0;
    }
    else
    {
        echo $obj->delTask($id);
        echo $obj->number();
        // $obj->numberOverride();
        
    }
}
