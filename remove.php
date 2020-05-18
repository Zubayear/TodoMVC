<?php
require 'vendor/autoload.php';
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
