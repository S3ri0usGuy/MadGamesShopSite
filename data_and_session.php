<?php
    session_start();

    $serwer = "localhost";
    $user = "root";
    $passwd = "";
    $database = "projektszbd_mad";
    
    $con = mysqli_connect($serwer,$user,$passwd,$database); 

    if(!$con){
        die("connection failed: ".mysqli_connect_error());
    }
?>