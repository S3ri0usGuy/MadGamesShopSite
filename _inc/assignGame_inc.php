<?php
    if(isset($_POST['buy_game'])){
        $game_id = $_POST['gameid'];

        require_once '../data_and_session.php';
        require_once 'functions_inc.php';
        
        if(ifUserHasGame($game_id) !== false){
            header("location: ../main.php?error=alreadyowned");
            exit();
        }
        if(assignGame($game_id) !== false ){
            header("location: ../main.php?error=assignGame");
            exit();
        }else{
            header("location: ../main.php?error=działa");
            exit();
        }
    }else{
        header("location: ../main.php?error=jak?");
        exit();
    }
?>