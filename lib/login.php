<?php

    $username = $_POST['user'];
    $password = $_POST['pass'];

    $con=mysqli_connect("localhost","root","","users");

    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    if ($result=mysqli_query($con,$sql)){
        $rowcount=mysqli_num_rows($result);
        if($rowcount > 0){
            ob_start();
            header('Location: ../notes.php'.$url);
            ob_end_flush();
            die();
        }else{
            header("location:../index.php");
        }
        mysqli_close($con);
    }
?>