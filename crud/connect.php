<?php 

$con=new mysqli('localhost','root','','instrument_project');

if(!$con){
    die(mysqli_error($con));  
} 

?>