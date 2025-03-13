<?php

$server='localhost';
$username="root";
$password="";
$database = 'pollingsystem';
$conn=mysqli_connect($server,$username,$password,$database);


if(!$conn){
    die("failed" . mysqli_connect_error());
}
// else{
//    echo "sucess";
// }

?>


