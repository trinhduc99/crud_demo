<?php

include "config.php";
if(isset($_POST['done'])){

  
$stmt = $con->prepare('INSERT INTO crud_table (username, password) values (?, ?)');


$stmt->bindParam(1, $username);
$stmt->bindParam(2, $password);


//Gán giá trị và thực thi
$username= $_POST['username'];
$password= $_POST['password'];
$stmt->execute();
   echo "New records created successfully";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="col-lg-6 m-auto">
    
    <form  method="post">
    <br><br>
    <div class="card">
    <div class="card-header bg-dark">
        <h1 class="text-white text-center">Insert Operation </h1>
    </div><br>

    <label for="">Username:</label>
    <input type="text" name="username" class="form-control"> <br>

    <label for="">Password:</label>
    <input type="password" name="password"> <br> 
    <button class="btn btn-success" type="submit" class="form-control" name= "done">Submit</button>
    <br>    
    </div>
    

    </form>

    </div>
</body>
</html>