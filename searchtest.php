<?php include 'data_and_session.php' ?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>X-D</title><!-- tak wiem że plik strony głównej chyba powinna nazywać się index czy coś -->
        <link rel="stylesheet" href="main_style.css">
    </head>
    <body>
        <?php
            include 'header.php'; //danke
        ?>
        <section class="main">
        
        <?php
            echo $_GET['searchbar'];
        ?>
            <div class="search_resault">
                <?php 
                    $search = $_GET['searchbar'];
                    // wyszukuje uzytkowników i gry
                    $req_1 = "SELECT game_id, game_name, game_score from games where game_name like '%$search%' Order by game_score desc";
                    $req_2 = "SELECT userName, UserID from users where userName like '%$search%'";
                    $res_1 = mysqli_query($con, $req_1);
                    $res_2 = mysqli_query($con, $req_2);
                    $resnum_1= mysqli_num_rows($res_1);
                    $resnum_2= mysqli_num_rows($res_2);
                    if($resnum_1 > 0 && $resnum_2 > 0 ){
                        while($row_1 = mysqli_fetch_array($res_1)){
                            echo '<div class="search_resault_pos"><img class="showcase_small_pic" src="gamepic/'.$row_1['game_id'].'/icon.png" alt="game icon"><p>'.$row_1["game_name"].'</p><button class="h_btn"><a href="gamepage.php?id='.$row_1['game_id'].'">Strona Gry</a></button></div>';
                        }
                        while($row_2 = mysqli_fetch_array($res_2)){
                            echo '<div class="search_resault_pos"><img class="showcase_small_pic" src="pfp/'.$row_2['UserID'].'.png" alt="pfp"><p>'.$row_2["userName"].'</p><button class="h_btn"><a href="profile.php?id='.$row_2['UserID'].'">Profil</a></button></div>';
                        }
                    } else if($resnum_1 > 0 && $resnum_2 == 0){
                        while($row_1 = mysqli_fetch_array($res_1)){
                            echo '<div class="search_resault_pos"><img class="showcase_small_pic" src="gamepic/'.$row_1['game_id'].'/icon.png" alt="game icon"><p>'.$row_1["game_name"].'</p><button class="h_btn"><a href="gamepage.php?id='.$row_1['game_id'].'">Strona Gry</a></button></div></div>';
                        }
                    }else if($resnum_1 == 0 && $resnum_2 > 0){
                        while($row_2 = mysqli_fetch_array($res_2)){
                            echo '<div class="search_resault_pos">
                            <img class="showcase_small_pic" src="pfp/'.$row_2['UserID'].'.png" alt="pfp">
                            <p>'.$row_2["userName"].'</p><button class="h_btn"><a href="profile.php?id='.$row_2['UserID'].'">Profil</a></button></div>';
                        }
                    } else {
                        echo '<p> nie udalo sie</p>';
                    }

                    mysqli_close($con)
                ?>
            </div>
            
        </section>
        <?php
            include 'footer.php'; //danke
        ?>
    </body>
</html>