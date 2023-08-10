<?php
    if(isset($_POST['submit'])){
        $usernameLogin = $_POST['luid'];
        $pwd = $_POST['pwd'];
    
        require_once '../data_and_session.php';
        require_once 'functions_inc.php';

        if (emptyInputLogin($usernameLogin, $pwd) !== false){
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        loginUser($con, $usernameLogin,$pwd);
    }else{
        header("location: ../login.php");
        exit();
    }
?>