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
                <form method="POST" action="_inc/signup_inc.php"><!-- wycentruj to gównno pls i nie wiem zrób temu css bo nie mam psychiki na to -->
                    <input type="text" name="luid" placeholder="Login Username"><br><!-- Login użytkownika - tego będzie użytkownik używał żeby się zalogować-->
                    <input type="text" name="name" placeholder="nickname/username"><br><!-- Nazwa użytkownika - to będzie się wyświetlało na profilu użytkownika i na chat -->
                    <input type="email" name="email" placeholder="Email"><br> <!--Email -->
                    <input type="password" name="pwd" placeholder="Password"><br><!-- Hasło -->
                    <input type="password" name="pwdRepeat" placeholder="Repeat password"><br><!--Powtórz hasło -->
                    <input type="submit" name="submit" value="Sign up">
                </form>
            </div>
            <?php
                if(isset($_GET["error"])){
                    if($_GET['error'] == 'emptyInput'){
                        echo '<p>Fill in all fields</p>';
                    }else if ($_GET['error'] == 'invalidLuid'){
                        echo '<p>choose proper login</p>';
                    }
                    else if ($_GET['error'] == 'invalidEmail'){
                    echo '<p>choose proper email</p>';
                    }
                    else if ($_GET['error'] == 'passworddontmatch'){
                    echo '<p>password dont match</p>';
                    }
                    else if ($_GET['error'] == 'stmtfailed'){
                    echo '<p>It is no good</p>';
                    }
                    else if ($_GET['error'] == 'logintaken'){
                    echo '<p>Login username taken</p>';
                    }
                    else if ($_GET['error'] == 'none'){
                    echo '<p>welcome to the voids of hell</p>';
                    }
                }
            ?>
        </section>
        <?php
            include 'footer.php'; //danke
        ?>
    </body>
</html>