
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="utf-8">
    <style>
    .pagination a, .pagination span{
        color:black;
        float:left;
        padding: 8px 16px;
        text-decoration:none;
        transition: background-color .3s;
    }
    .pagination span {
  background-color: dodgerblue;
  color: white;
}
    .pagination a:hover{
        background-color:#ddd;
    }
    .pagination{
        text-aline:center;
    }
    </style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
//b1: ket noi csdl
include "config.php";
//b2: tim tong so records
$sql=$con->prepare( " SELECT count(id) as total from crud_table ");
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
   <div class="container">
       <div class="col-lg-12">
           <h1 class="text-warning text-center">Display Table Data</h1>
           <br>
           <table class="table table-striped table-hover table-bordered">
           <tr class="bg-dark text-white text-center">
               <th>Id</th>
               <th>Username</th>
               <th>Password</th>
               <th>Delete</th>
               <th>Update</th>
           </tr>
           <?php
           include "config.php";

           $sql=$con->prepare( " SELECT * FROM `crud_table` limit $start, $limit  ");
           $sql->execute();
                while($res = $sql->fetch(PDO::FETCH_ASSOC)){

            ?>
           <tr>
           <tr class="text-center">
               <th><?php echo $res['id']; ?></th>
               <th><?php echo $res['username']; ?></th>
               <th><?php echo $res['password']; ?></th>
               <th><button class="btn-danger btn"><a class="text-white"  href="delete.php?id=<?php echo $res['id']; ?>">Delete</a></button></th>
               <th><button class="btn-primary btn"><a class="text-white" href="update.php?id=<?php echo $res['id'];?>&&username=<?php echo $res['username']; ?>">Update</a></button></th>
               
           </tr>
           <?php
                }
           ?>
           </tr>
           </table>
       </div>
   </div>
   <div class="container">
   <nav aria-label="Page navigation example">
        <ul class="pagination col-lg-12">
           <?php 
            
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG
 
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="display.php?page='.($current_page-1).'">&laquo;</a>  ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                    echo '<span>'.$i.'</span>  ';
                }
                else{
                    echo '<a href="display.php?page='.$i.'">'.$i.'</a>  ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="display.php?page='.($current_page+1).'">&raquo;</a>  ';
            }
           ?>
        </ul>
        </nav>
        </div>
</body>
</html>