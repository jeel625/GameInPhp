<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    session_start();      
    include('connection.php');  

    $username="";
    $password="";

    $username=$_SESSION['name'];
    $password=$_SESSION['password'];

    
    $connection = new mysqli('localhost', 'root', '','finalprojectgame');
    $sql = "SELECT * FROM login WHERE TempPassword = '$password' and UserName = '$username'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);
    
   
    if($count==1)
    {   
        echo "<script>window.location.href = '../../homepage/homepage.php'</script>";
    }  
    else{  
        echo "<h1> Login failed. Invalid username or password.</h1>"; 
        echo "<a href='../../index.php'>Back To Login Page</a>" ;
    }     
    mysqli_close($con);
?> 