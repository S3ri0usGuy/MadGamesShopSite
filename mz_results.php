<?php session_start(); ?>
<!DOCTYPE html>
<html lang='pl'>
<head>
<meta charset='utf-8'>
<link rel='shortcut icon' href='favicon.ico'/>
<link rel='stylesheet' type='text/css' href='main_style.css'>
<title>Wyniki z Maze jumper</title>
</head>
<body>
        <?php include 'header.php'; //danke?>
    <p>Prezentujemy wyniki graczy z "Maze Jumper"</p>
    <table>
        <tr><th>NR</th><th>Nazwa</th><th>Level</th><th>Punkty</th></tr>
        <?php 

            $conn = mysqli_connect("localhost", "root", "", "ProjektMAD");
            $sql = "SELECT Users.Name as n, MazeJumper.Level as l, MazeJumper.Points as p FROM MazeJumper INNER JOIN Users ON Users.UserID = MazeJumper.UserID ORDER BY MazeJumper.Points DESC LIMIT 10";

            $result = mysqli_query($conn, $sql);
            $NR = 1;

            while($row = mysqli_fetch_array($result))
            {
                echo "<tr><th>".$NR."</th><td>".$row["n"]."</td><td>".$row["l"]."</td><td>".$row["p"]."</td></tr>";
                $NR++;
            }

            mysqli_close($conn);
        ?>
    </table>
    <?php include 'footer.php'; //danke?>
</body>
</html>