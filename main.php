<?php include 'data_and_session.php'
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>MAD games</title><!-- tak wiem że plik strony głównej chyba powinna nazywać się index czy coś -->
    <link rel="stylesheet" href="main_style.css">
</head>
<body>
    <?php
    include 'header.php'; //danke
    //print_r($_SESSION);
    ?>
    <section class="main">
        <div id="m_showcase_big"><!--tu będzie wyświetlana albo wybrana przez nas gra albo ostatnia oglądana przez użytkownika -->
            
            <?php 
                
                $req = 'SELECT game_name, game_desc, game_id from games where game_score=88';
                $res = mysqli_query($con, $req);

                while($row = mysqli_fetch_array($res)){
                    echo '<img src="gamepic/'.$row['game_id'].'/baner.png" alt="no chuj" id="showcase_big_pic">';
                    echo '<p id="showcase_big_title">'.$row["game_name"].'</p><br>';
                    echo '<div id="showcase_big_desc_div"> <p id="showcase_big_desc">'.$row["game_desc"].'<br></p> </div>';//zajebista br
                    echo '<div id="btn_edit"> <button class="h_btn"><a href="gamepage.php?id='.$row['game_id'].'">Przejdz do gry</a></button> </div>';
                }

            ?>
            
        </div>
        <br>
        <div id="m_showcase_small"><!--tu będą wyświetlane wybrane przez nas gry lub ostatnie oglądane gry przez użytkownika || za duże przyciski ale pomagają określić orientacyjną wielkość tych pul -->
            <?php
                $req = 'SELECT game_name, game_id, game_desc from games where game_score<=81';
                $res = mysqli_query($con, $req);

                while($row = mysqli_fetch_array($res)){
                    echo '<div class="showcase_small"> 
                            <img src="gamepic/'.$row['game_id'].'/icon.png" alt="no chuj" class="showcase_small_pic">
                            <p>'.$row["game_name"].'</p>
                            <div class="bnt_edit_small"> <button class="h_btn"><a href="gamepage.php?id='.$row['game_id'].'">Przejdz do gry</a></button> </div>
                            </div>';// za szerokie po wstawieniu tytułu
                }
            ?>
            <!--<div class="showcase_small">
                <img src="" alt="no chuj">
                <p>Title</p>
                <button class="h_btn">Przejdz do gry</button>
            </div>(x4)-->   
        </div>
        <br>
    </section>
    <?php
        include 'footer.php'; //danke
    ?>
</body>
</html>