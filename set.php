<?php
require 'vendor/autoload.php';

$obj = new Tasks();
if(isset($_POST['name']))
{
    $name = $_POST['name'];

    if(empty($name))
    {
        header("Location: index.php?mess=error");
    }
    else 
    {
        $res = $obj->setTask($name);
        
        if($res)
        {
            header("Location: index.php?mess=success");
        }
        else
        {
            header("Location: index.php");
        }
    }
}
else {
    header("Location: index.php?mess=error");
}
