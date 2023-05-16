<?php

// mysql_connect("database-host", "username", "password")
//phpinfo();

$servername = "localhost";
$database = "crud";
$username = "root";
$password = "";
//connection
$conn = mysqli_connect($servername, $username, $password,$database ); 

if(!$conn)
{
    die("cannot connected");
   }
   
?>