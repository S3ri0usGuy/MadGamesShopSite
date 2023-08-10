<?php
    function emptyInputSignup($name,$login,$email,$pwd,$pwdRepeat){
        $resault = false;
        if(empty($name)||empty($login)||empty($email)||empty($pwd)||empty($pwdRepeat)){
            $resault = true;
        }else {
            $resault = false;
        }
        return $resault;
    }

    function invalidLuid($login){
        $resault = false;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $login)){
            $resault = true;
        }else {
            $resault = false;
        }
        return $resault;
    }

    function invalidEmail($email){
        $resault = false;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $resault = true;
        }else {
            $resault = false;
        }
        return $resault;
    }
    
    function pwdMatch($pwd,$pwdRepeat){
        $resault = false;
        if($pwd !== $pwdRepeat){
            $resault = true;
        }else {
            $resault = false;
        }
        return $resault;
    }

    function luidExists($con,$login,$email){
        $req = "SELECT * from users where userLuid = ? OR userEmail = ?;";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $req)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ss", $login, $email);
        mysqli_stmt_execute($stmt);
        $resaultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resaultData)){
            return $row;
        }else{
            $resault = false;
            return $resault;
        }
        mysqli_stmt_close($stmt);
    }
    
    function createUser($con,$name,$login,$email,$pwd){
        $req = "INSERT INTO users(userNAME, userLuid, userEmail, userPwd) VALUES(?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $req)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt,"ssss", $name,$login,$email,$hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../signup.php?error=none");
        exit();
    }
    
    function emptyInputLogin($usernameLogin,$pwd){
        $resault = false;
        if(empty($usernameLogin)||empty($pwd)){
            $resault = true;
        }else {
            $resault = false;
        }
        return $resault;
    }
    
    function loginUser($con,$usernameLogin,$pwd){
        $luidExists = luidExists($con,$usernameLogin,$usernameLogin);

        if($luidExists === false){
            header("location: ../login.php?error=wronglogin");
            exit();
        }
        $hashedPwd = $luidExists["userPwd"];
        $checkPwd = password_verify($pwd,$hashedPwd);
        
        if($checkPwd === false){
            header("location: ../login.php?error=wronglogin");
            exit();
        }else if($checkPwd === true){
            session_start();
            $_SESSION["userID"] = $luidExists["UserID"];
            $_SESSION["userName"] = $luidExists["userName"];
            $_SESSION["userLuid"] = $luidExists["userLuid"];
            $_SESSION["userEmail"] = $luidExists["userEmail"];
            header("location: ../main.php");
            exit();
        }
    }

    function getUserData($id){
        //pomocy z tym 
        $serwer = "localhost";
        $user = "root";
        $passwd = "";
        $database = "projektszbd_mad";
    
        $con = mysqli_connect($serwer,$user,$passwd,$database); //  to jest głupie ale nie chce mi się z tym jebać teraz naprawde pomocy - Abel
        //przygotowanie pod wyświetlanie innych uzytkowników
        $req = "SELECT * FROM users where UserID = $id";
        $userArray = array();
        $res = mysqli_query($con, $req);
        while($row = mysqli_fetch_assoc($res)){
            $userArray['userID'] = $row['UserID'];
            $userArray['userName'] = $row['userName'];
        }
        return $userArray;
    }
    function getUserID($username){
        //pomocy z tym 
        $serwer = "localhost";
        $user = "root";
        $passwd = "";
        $database = "projektszbd_mad";
    
        $con = mysqli_connect($serwer,$user,$passwd,$database); // to jest głupie ale nie chce mi się z tym jebać teraz naprawde pomocy - Abel
        //przygotowanie pod wyświetlanie innych uzytkowników
        $req = "SELECT * FROM users where userName = '$username'";
        $res = mysqli_query($con,$req);
        while($row = mysqli_fetch_assoc($res)){
            return $row['UserID'];
        }
    }

    function userExists($id){
        //pomocy z tym 
        $serwer = "localhost";
        $user = "root";
        $passwd = "";
        $database = "projektszbd_mad";
            
        $con = mysqli_connect($serwer,$user,$passwd,$database); // to jest głupie ale nie chce mi się z tym jebać teraz naprawde pomocy - Abel
        $req = "SELECT UserID FROM users where UserID = '$id'";
        $numrows = mysqli_num_rows(mysqli_query($con,$req));
        if($numrows==1){
            return true;
        }else {
            return false;
        }
    }

    function getGameData($game_id){
        //pomocy z tym 
        $serwer = "localhost";
        $user = "root";
        $passwd = "";
        $database = "projektszbd_mad";
    
        $con = mysqli_connect($serwer,$user,$passwd,$database); //  to jest głupie ale nie chce mi się z tym jebać teraz naprawde pomocy - Abel
        //przygotowanie pod wyświetlanie innych uzytkowników
        $req = "SELECT * FROM games where game_id = $game_id";
        $res = mysqli_query($con, $req);

        $gameArray = array();
        while($row = mysqli_fetch_assoc($res)){
            $gameArray['gameID'] = $row['game_id'];
            $gameArray['gameName'] = $row['game_name'];
            $gameArray['gameSpec'] = $row['game_spec'];
            $gameArray['gameDesc'] = $row['game_desc'];
            $gameArray['gamePrice'] = $row['game_price'];
            $gameArray['gameAge'] = $row['game_agerest'];
        }
        return $gameArray;
    }

    function getGameID($gameName){
        //pomocy z tym 
        $serwer = "localhost";
        $user = "root";
        $passwd = "";
        $database = "projektszbd_mad";
    
        $con = mysqli_connect($serwer,$user,$passwd,$database); // to jest głupie ale nie chce mi się z tym jebać teraz naprawde pomocy - Abel
        //przygotowanie pod wyświetlanie innych uzytkowników
        $req = "SELECT * FROM games where game_name = '$gameName'";
        $res = mysqli_query($con,$req);
        while($row = mysqli_fetch_assoc($res)){
            return $row['game_name'];
        }
    }
    function ifUserHasGame($id){
         //pomocy z tym 
        $serwer = "localhost";
        $user = "root";
        $passwd = "";
        $database = "projektszbd_mad";

        $con = mysqli_connect($serwer,$user,$passwd,$database); // to jest głupie ale nie chce mi się z tym jebać teraz naprawde pomocy - Abel
        $userID = $_SESSION['userID'];
        $req = "SELECT * FROM inventory INNER JOIN games ON inventory.game_id = games.game_id WHERE inventory.userID = $userID AND inventory.game_id = $id";
        $numrows = mysqli_num_rows(mysqli_query($con,$req));
        if($numrows==1){
            return true;
        }else{
            return false;
        }
    }

    function assignGame($game_id){
        //pomocy z tym 
        $serwer = "localhost";
        $user = "root";
        $passwd = "";
        $database = "projektszbd_mad";
    
        $con = mysqli_connect($serwer,$user,$passwd,$database); // to jest głupie ale nie chce mi się z tym jebać teraz naprawde pomocy - Abel
        
        $req ="SELECT game_price FROM games WHERE game_id = $game_id";
        $res = mysqli_query($con, $req);
        while($row = mysqli_fetch_array($res)){
            $game_price = $row['game_price'];
        }
        #region NRB 1

        $req ="SELECT userNRB FROM users WHERE UserID =".$_SESSION['userID'];
        $res = mysqli_query($con, $req);
        while($row = mysqli_fetch_array($res)){
            $unrb = $row['userNRB'];
        }


        $conNRB = mysqli_connect($serwer,$user,$passwd, "bank");
        $reqNRB ="SELECT hm FROM users WHERE userNRB = '$unrb'";
        $resNRB = mysqli_query($conNRB, $reqNRB);
        while($row = mysqli_fetch_array($resNRB)){
            $uhmNRB = $row['hm'];
        }

        if ($uhmNRB>=$game_price)
        {
            #endregion
            $t=time();
            $date = date("Y-m-d",$t);
            $userID = $_SESSION['userID'];
            
            $reqCreateBill = "INSERT INTO billing (bill_date, game_id, bill_price, bill_discount) VALUES ('$date','$game_id','$game_price','')";
            mysqli_query($con, $reqCreateBill);
            #region NRB 2
            $hisNRB = "INSERT INTO `u_history` (`fuNRB`, `suNRB`, `hm`, `date`, `comment`) VALUES ('111223388856446', '$unrb', $game_price, current_timestamp(), 'For game')";
            mysqli_query($conNRB, $hisNRB);

            $fuNRB = "UPDATE `users` SET hm = (hm + $game_price) WHERE userNRB = '111223388856446'";
            $suNRB = "UPDATE `users` SET hm = (hm - $game_price) WHERE userNRB = '$unrb'";

            mysqli_query($conNRB, $fuNRB);
            mysqli_query($conNRB, $suNRB);

            mysqli_close($conNRB);
            #endregion
            $reqRecentBill = "SELECT MAX(bill_id) as id_bill FROM billing";
            $resRecentBill = mysqli_query($con,$reqRecentBill);
            while ($row = mysqli_fetch_array($resRecentBill)) {
                $recentBillAdd = $row['id_bill'];
            }

            $reqCheckAndGetData = "SELECT bill_id, game_id FROM billing WHERE bill_id = $recentBillAdd AND game_id = $game_id";
            $resCheckAndGetData = mysqli_query($con,$reqCheckAndGetData);
            $numrows = mysqli_num_rows($resCheckAndGetData);
            if($numrows == 0){
                return true;
                header("location: ../main.php?error=XD");
                exit();
            }else{
                while($row = mysqli_fetch_array($resCheckAndGetData)){
                    $insertBill = $row['bill_id'];
                    $insertGame = $row['game_id'];
                }

                $reqAddGame = "INSERT INTO inventory (userID,bill_id,game_id) VALUES ('$userID', '$insertBill','$insertGame')";
                mysqli_query($con, $reqAddGame);
                return false;
            }
        }
        else
        {
            echo " You don't have power here";
        }
    }
?>
