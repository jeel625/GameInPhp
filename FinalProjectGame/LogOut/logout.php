<?php

    session_start();

    $userN=$_SESSION['name'];
    $password=$_SESSION['password'];
    $date=date("Y/m/d");

    $connection = new mysqli('localhost', 'root', '','finalprojectgame');
    $sql_select_query = "UPDATE login SET dateAndTime ='$date'  WHERE TempPassword= '$password' and UserName = '$userN'";
    $select_query = $connection->query($sql_select_query);


    unset($_SESSION['name']);
    unset($_SESSION['password']);

    echo "<script>window.location.href='../index.php';</script>";


?>