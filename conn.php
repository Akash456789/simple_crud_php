<?php
$host="localhost";
$name="root";
$password="";
$db="simple_crud";

$con = mysqli_connect($host, $name, $password, $db);

if($con){
    echo "connect";
}else{
    echo "not conn";
}
?>