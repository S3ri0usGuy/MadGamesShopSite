<?php include 'data_and_session.php';
    require_once '_inc/functions_inc.php';
    if(!isset($_GET['id'])){ 
        //header("location: ?id=".getGameID()); <-- tu trzeba coś wpisać żeby wrazie czego działało ale działa bez
        echo'jak?';
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<title>X-D</title>
<meta charset="utf-8">
<link rel="stylesheet" href="main_style.css">
</head>
<body>
<?php
    include 'header.php'; //danke
    //print_r($_SESSION);
?>
<section class="main">
    <?php 
    $gamePageData = getGameData($_GET['id']);
    //print_r($gamePageData); ?>
    <br>
    <div class="gamebg">
    <div class="gamepage_up">
        <img src="gamepic/<?php echo $_GET['id'];?>/baner.png" alt="baner" id="gamepage_baner">
        <div class="gamepage_info">
            <p><?php echo 'Cena: '.$gamePageData['gamePrice']; ?></p>
            <br>
            <p> <?php echo 'Wiek: '.$gamePageData['gameAge']; ?></p>
        </div>
            <form action="_inc/assignGame_inc.php" method="POST" id="gamepage_buy">
                <input type="number" style="display:none ;" name="gameid" value="<?php echo $_GET['id'];//działa działa nie zadawaj pytań ?>">
            </form>
    </div>
    
    <div class="gamepage_down">
    <h1 id="gamepage_name"><?php echo $gamePageData['gameName']; ?></h1>
        <p><?php echo $gamePageData['gameDesc']; ?></p>
        <br><br>
        <p><?php echo $gamePageData['gameSpec']; ?></p>
        <input type="submit" name="buy_game" value="BUY" class="h_btn">
    </div>
</div>
</section>
<?php
    include 'footer.php'; //danke
?>
</body>
</html>