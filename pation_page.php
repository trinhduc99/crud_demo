<?php
//b1: ket noi csdl
include "config.php";
//b2: tim tong so records
$sql=$con->prepare( " SELECT count(id) as total from todolist_table ");
$sql->execute();
$res = $sql->fetch(PDO::FETCH_ASSOC);
$total_records= $res['total'];
//b3:tim limit va current_page
$current_page= isset($_GET['page'])?$_GET['page']:1;
$limit=5;
//b4: TInh toan totoal_page va start
//Tong so trang
$total_page= ceil($total_records/$limit);
//Gioi han current_page trong khoang 1 den total_page
if($current_page>$total_page){
    $current_page=$total_page;
}
else if($current_page<1){
    $current_page=1;
}
//Tim start
$start= ($current_page-1)* $limit;
//b5: Truy van lay danh sach tin tuc
//Co limit va start roif thi truy van csdl lay danh sach
?>