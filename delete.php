<?php 
include 'config.php';

$id= $_GET['id'];

$sql= "DELETE FROM `crud_table` WHERE id= $id";
$con->exec($sql);
header('location:display.php');
?>