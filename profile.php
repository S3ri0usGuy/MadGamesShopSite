<?php include 'data_and_session.php' ;
require_once '_inc/functions_inc.php';
if(!isset($_GET['id'])){ 
    header("location: ?id=".getUserID($_SESSION["userName"]));
}
?>
<!DOCTYPE html><!--Pokazyje profil w zaleznosci od jego ID -->
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>X-D</title><!-- tak wiem że plik strony głównej chyba powinna nazywać się index czy coś -->
        <link rel="stylesheet" href="main_style.css">
    </head>
    <body>
        <?php
            include 'header.php'; //danke
            //print_r($_SESSION);
        ?>
        <section class="main">
            <?php
                require_once '_inc/functions_inc.php';
                if(isset($_SESSION['userName'])){
                    $userProfileData = getUserData(mysqli_real_escape_string($con, $_GET['id']));
                    //print_r($userProfileData = getUserData(getUserID($_SESSION['userName']))); <-- nie dotykać czy coś nie wiem
                }
                if(userExists(mysqli_real_escape_string($con, $_GET['id']))){
                    if(isset($_SESSION["userName"])){
                        //pojawiają się błędy kiedy próbuje przeglądać profile użytkowników gdy nie jestem zalogowany na konto pokazują się errory z php bo sesja nie jest ustawiona
                        //to obchodzi problem nie rozwiązuje go ale działa
            ?>
            <div class="h_prfl">
                <div class="p_pfp">
                    <?php
                    echo '<img src="pfp/'.$userProfileData['userID'].'.png" alt="profile picture" class="pfp">';
                    ?>
                </div>
                <div class="p_nick">
                    <p class="nick"><?php echo $userProfileData['userName']?></p>
                </div>
                <div class="p_btns">
                    <input type="button" value="idk add or smth" class="h_btn"> 
                </div>
            </div>
            <br>
            <div class="m_prfl">
                <div class="p_games"><!--class="div2"-->
                    <p style="text-align: center;">Gry</p>
                    <?php 
                    $user_id = $_GET['id']; 
                    $req = "SELECT * from inventory INNER JOIN games ON games.game_id = inventory.game_id where inventory.userID = $user_id";
                    $res = mysqli_query($con, $req) ;
                    
                    while($row = mysqli_fetch_array($res)){
                        echo '<div class="p_game">
                        <img src="gamepic/'.$row['game_id'].'/icon.png" alt="game pic" class="game_pic">
                        <p class="game_name">'.$row['game_name'].'</p>
                        </div>' ;
                    }
                    ?>
                    <!--
                    <div class="p_game">
                        <img src="" alt="game pic" class="game_pic">
                        <p class="game_name">nazwa</p>
                    </div>
                    -->
                </div>
            </div>
            <?php
                }else{
                    echo 'musisz być zalogowanym żeby przeglądać profile użytkowników';
                }
            } else {
                echo 'invalid ID';
            }
            ?>
        </section>
        <?php
            include 'footer.php'; //danke
        ?>
    </body>
</html>