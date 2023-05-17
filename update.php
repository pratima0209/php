<?php
include 'conn.php';
$id=$_GET['updateid'];
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobno'];
    $password=$_POST['pwd'];
    



$sql="update `user` set id=$id,name='$name',email='$email',mobile='$mobile',password='$password'
where id=$id";
$result=mysqli_query($conn,$sql);
if($result)
{
    echo"updated succesfully";
    //header('location:display.php');
}else
{
    die(mysqli_error($conn));
}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Crud Operation</title>
            <h2>user info</h2>
</head>
  <body>
    <div class="container my-5">
    <form method="post">
        <div class="form-group">
            <label>Enter your name:</label>
            <input type="text" class="form-control"
            placeholder="Enter your name" name="name" autocomplete="off">
        </div><br>
        <div class="form-group">
            <label>Enter your email:</label>
            <input type="text" class="form-control"
            placeholder="Enter your mail" name="email" autocomplete="off" >
        </div><br>
        <div class="form-group">
            <label>Enter your mobileno:</label>
            <input type="text" class="form-control"
            placeholder="Enter your mobno" name="mobno" autocomplete="off" >
        </div><br>
        <div class="form-group">
            <label>Enter your password</label>
            <input type="text" class="form-control"
            placeholder="Enter your password" name="pwd" autocomplete="off">
        </div><br>
  
  <button type="submit" name="submit" class="btn btn-primary">Update</button>
</form>
</div>

   
  </body>
</html>