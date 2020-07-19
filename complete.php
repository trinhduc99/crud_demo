<?php
       include "config.php";
       $id= $_GET['id'];

      $sql= "UPDATE `todolist_table` SET `id`=$id,`completeId`=1 WHERE `id`=$id";
      $con->exec($sql);
    header('location:index.php');
?>