
<?php
            include "create.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
                    /* Include the padding and border in an element's total width and height */
            * {
                box-sizing: border-box;
            }
            
            /* Remove margins and padding from the list */
            ul {
                margin: 0;
                padding: 0;
            }
            
            /* Style the list items */
            ul li {
                cursor: pointer;
                position: relative;
                padding: 12px 8px 12px 40px;
                background: #eee;
                font-size: 18px;
                transition: 0.2s;
            
                /* make the list items unselectable */
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            
            /* Set all odd list items to a different color (zebra-stripes) */
            ul li:nth-child(odd) {
                background: #f9f9f9;
            }
            
            /* Darker background-color on hover */
            ul li:hover {
                background: #ddd;
            }
            
            /* When clicked on, add a background color and strike out text */
            ul li.checked {
                background: #888;
                color: #fff;
                text-decoration: line-through;
            }
            
            /* Add a "checked" mark when clicked on */
            ul li.checked::before {
                content: '';
                position: absolute;
                border-color: #fff;
                border-style: solid;
                border-width: 0 2px 2px 0;
                top: 10px;
                left: 16px;
                transform: rotate(45deg);
                height: 15px;
                width: 7px;
            }
            
            /* Style the close button */
            .close {
                position: absolute;
                right: 0;
                top: 0;
                padding: 12px 16px 12px 16px;
            }
            
            .close:hover {
                background-color: #f44336;
                color: white;
            }
            
            /* Style the header */
            .header {
                background-color: #f44336;
                padding: 30px 40px;
                color: white;
                text-align: center;
            }
            
            /* Clear floats after the header */
            .header:after {
                content: "";
                display: table;
                clear: both;
            }
            
            /* Style the input */
            input {
                margin: 0;
                border: none;
                border-radius: 0;
                width: 75%;
                padding: 10px;
                float: left;
                font-size: 16px;
            }
            
            /* Style the "Add" button */
            .addBtn {
                padding: 10px;
                width: 25%;
                background: #d9d9d9;
                color: #555;
                float: left;
                text-align: center;
                font-size: 16px;
                cursor: pointer;
                transition: 0.3s;
                border-radius: 0;
            }
            
            .addBtn:hover {
                background-color: #bbb;
            }
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
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<script src="main.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script>
    function validateForm()
{
    var list = document.getElementById('myInput').value;
    if (list == ''){
        alert('Bạn chưa nhap todolist');
    }
    else{
        alert('Insert thành công');
        return true;
    }
 
    return false;
}</script> -->
    <title>My Simple To Do List</title>
</head>

<body>
<?php
    include "pation_page.php";
?>
        <div id="myDIV" class="header">
        <h2>My To Do List</h2>
        <?php echo isset($error['list']) ? $error['list'] : ''; 
         header('location:index.php');
        ?>
        <form action="" method="post" >
        <input type="text" name="list" id="myInput" value="<?= isset($data['list']) ? $data['list'] : ''; ?>" placeholder="">
        <input type= "submit" name="done" value= "Add"  class="addBtn">
        </form>
        </div>

<ul id="myUL" style= "" >
    <?php
    include "config.php";
    $sql= $con->prepare(" SELECT * FROM  todolist_table order by id desc limit $start, $limit ");
    $sql->execute();
    // $res = $sql->fetch(PDO::FETCH_ASSOC);
    // var_dump(is_int($res['id']));
    
    while($res = $sql->fetch(PDO::FETCH_ASSOC)){
    ?>
    <ul>
        
        <li>
        
        <?php
        if($res['completeId']==0){
        ?>
            <a href="complete.php?id=<?= $res['id'];?>"><i class='far fa-circle' style='font-size:32px'>
            </i></a>
            <i><?= $res["list"]?></i>
        <?php
        }
        else{
        ?>
        <a href="un_complete.php?id=<?= $res['id'];?>"><i class='far fa-check-circle' style='font-size:32px'></i></a>
        <i style="text-decoration: line-through;"><?= $res["list"]?></i>
        <?php
        }?>

            <a href="update.php?id=<?= $res['id'];?>"><i class="fa fa-wrench" style="font-size:32px; float:right;"></i></a>
            <a href="delete.php?id=<?= $res['id']; ?>"><i class="material-icons" style="font-size:32px; float:right;" >delete</i></a>

        </li>
  
    </ul>
  <?php
    }?>
</ul>

<div class="container">
   <nav aria-label="Page navigation example">
        <ul class="pagination col-lg-12">
           <?php 
            
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG
 
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="index.php?page='.($current_page-1).'">&laquo;</a>  ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                    echo '<span>'.$i.'</span>  ';
                }
                else{
                    echo '<a href="index.php?page='.$i.'">'.$i.'</a>  ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="index.php?page='.($current_page+1).'">&raquo;</a>  ';
            }
           ?>
        </ul>
        </nav>
        </div>
</body>
</html>


