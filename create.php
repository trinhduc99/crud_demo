<?php
            include "config.php";
            $error = array();
            $data = array();
            if(isset($_POST['done'])){
            
            $data['list']= isset($_POST['list'])?$_POST['list']:"";

            //Kiem tra dinh dang du lieu
            require('./validate.php');
            if(empty($data['list'])){
                $error['list'] = " <script>
                alert('Ban chua nhap ten');
                </script>";
            }
            else if (!is_list($data['list'])){
                $error['list'] = " <script>
                alert('List chi bao gom chu va dau cach');
                </script>";
            }

            // Lưu dữ liệu
            if (!$error){
                echo " <script>
                    alert('Insert thanh cong');
                    </script>";
                $stmt = $con->prepare('INSERT INTO todolist_table (list) values (?)');

                $stmt->bindParam(1, $list);
    
                //Gán giá trị và thực thi
                $list= $data['list'];
                $stmt->execute();
            }
            else{
               
                echo " <script>
                    alert('Dữ liệu bị lỗi, không thể lưu trữ');
                    </script>";
                
            }

            
            }
            

?>