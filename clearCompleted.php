
<?php

require 'vendor/autoload.php';
$obj = new Tasks();

// $val = $_POST['ids'];
// foreach($val as $v) {
//     $obj->delTask($v);
    
// }
// echo $obj->number();
$obj->clearCompleted(); 
echo $obj->number();
// header("Location: index.php");


// $array = json_decode($_POST["ids"]);


// $response = array();
// if(isset($array[$blah])) {
//     $response['reply'] = "Sucess";
// }
// else {
//     $response['reply'] = "Failure";
// }
// echo json_encode($response);


// print_r($a);

// var_dump($val);
// foreach($val as $v) {
//     echo $obj->delTask($v);
// }
// header("Location: index.php");
