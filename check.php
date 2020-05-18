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
        echo 'error';
    }
    else
    {
        $obj->checked($id);
        $newObj = $obj->items();
        echo $newObj[0]['COUNT(checked)'];
    }
}
else
{
    header("Location: index.php?mess=error");
}
