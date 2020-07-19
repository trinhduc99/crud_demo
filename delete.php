<?php 
include 'config.php';

$id= $_GET['id'];

$sql= "DELETE FROM `todolist_table` WHERE id= $id";
$con->exec($sql);
header('location:index.php');
?>