<?php
include('conn.php');
$id=$_GET['id'];

$query="delete from job where id='$id'";
$dele=mysqli_query($con, $query);
if($dele){
    echo "data delete";
    header('location:display.php');
}else{
    echo "data not delete";
}

?>