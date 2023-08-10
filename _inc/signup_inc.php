<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $login = $_POST['luid'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdRepeat'];

    require_once '../data_and_session.php';
    require_once 'functions_inc.php';

    if(emptyInputSignup($name,$login,$email,$pwd,$pwdRepeat)!= false){
        header("location: ../signup.php error=emptyinput");
        exit();
    }
    
    if(invalidLuid($login)!== false){
        header("location: ../signup.php error=invalidLuid");
        exit();
    }
    if(invalidEmail($email)!== false){
        header("location: ../signup.php error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd,$pwdRepeat)!== false){
        header("location: ../signup.php error=passworddontmatch");
        exit();
    }
    if(luidExists($con,$login,$email)!== false){
        header("location: ../signup.php error=logintaken");
        exit();
    }

    createUser($con,$name,$login,$email,$pwd);

}else{
    header("location: ../signup.php");
    exit();
}
