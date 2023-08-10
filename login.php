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
            <div class="signup_form"><!-- można dodać label-->
                <form method="POST" action="_inc/login_inc.php"><!-- wycentruj to gównno pls i nie wiem zrób temu css bo nie mam psychiki na to -->
                    <input type="text" name="luid" placeholder="Login Username/Email"><br> <!-- Logowanie za pomocą loginu(luid) lub Email -->
                    <input type="password" name="pwd" placeholder="Password"><br>
                    <input type="submit" name="submit" value="Login">
                </form>
            </div>
            <?php
                if(isset($_GET["error"])){
                    if($_GET['error'] == 'emptyInput'){
                        echo '<p>Fill in all fields</p>';
                    }else if ($_GET['error'] == 'wronglogin'){
                        echo '<p>wrong login password</p>';
                    }
                }
            ?>
        </section>
        <?php
            include 'footer.php'; //danke
        ?>
    </body>
</html>