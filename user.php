<?php
include 'conn.php';
$error="";
$e1="";
$e2="";
$e3="";
//$flag=true;
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['pwd'];
    
    
    if(preg_match("/^([a-zA-Z' ]+)$/",$name)){
        //$error= 'Valid name given.';
    }else{
        $e1='Invalid name given.<br>';
  //      $flag=false;
    }    

    $mobile=$_POST['mobno'];

    if(empty($mobile))
    {
        $error="please enter mob no";
    }
    elseif(strlen($mobile)<10)
    {
        $error="mob no should be 10 digit";
    }

    elseif(!preg_match('/^[6-9]\d{9}$/',$mobile))
     
    {
        $error="invalid mob no";
    }


    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $e2="$email is a valid email address";
    } 
    else {
        $e2=" Invalid email address<br>";
    //    $flag=false;
    }

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $e3= 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
      //  $flag=false;
    }else{
        echo 'Strong password.';
    }
    $sql="insert into `user`(name,email,mobile,password) values('$name','$email','$mobile','$password')";
    if($error=="")
    {
    $result=mysqli_query($conn,$sql);
    }
    else{
        $result=True;
    }
    if($result)
    {
        //echo"data inserted succesfully";
     if ($error=="")
    {
        header('location:display.php');
        }
        
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
    <h2 center>user info</h2>
    <style type="text/css">
        .error{
            color: red;
            font-size: 13px;
}
        
</style>
</head>
  <body>
    <div class="container my-5">
    <form method="post">
        <div class="form-group">
            <label>Enter your name:</label>
            <input type="text" class="form-control"
            placeholder="Enter your name" name="name" autocomplete="off">
            <span class="error"><?php echo $e1; ?></span>


        </div><br>
        <div class="form-group">
            <label>Enter your email:</label>
            <input type="text" class="form-control"
            placeholder="Enter your mail" name="email" autocomplete="off" >
            <span class="error"><?php echo $e2; ?></span>


        </div><br>
        <div class="form-group">
            <label>Enter your mobileno:</label>
            <input type="text" class="form-control"
            placeholder="Enter your mobno" name="mobno" autocomplete="off" >
            <span class="error"><?php echo $error; ?></span>
        </div><br>
        <div class="form-group">
            <label>Enter your password</label>
            <input type="text" class="form-control"
            placeholder="Enter your password" name="pwd" autocomplete="off">
            <span class="error"><?php echo $e3; ?></span>


        </div><br>
  
  <button type="submit" id ="btn" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    let btn=document.getElementById("btn")
    btn=addEventListener("click",function(){
        swal("Good job!", "You clicked the button!", "success");

    });
</script>
  </body>
</html>