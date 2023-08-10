        <header id="header">
            <!--<div class="hdr_obj">
                <img src="logo.png" alt="logo" id="hdr_logo" width="150" height="75">
            </div> -->
            <div  class="hdr_obj">
                <!--button class="h_btn"--><a href="main.php"><img src="logo.png" alt="logo" id="hdr_logo" width="150" height="75"></a><!--/button--><!-- można scalić przycisk z logiem czy coś -->
            </div>
            <div class="hdr_obj">
                <form method="GET" action="searchtest.php">
                    <input type="search" id="srch" name='searchbar' placeholder="Search">
                    <input type="submit" value="search" class="h_btn">
                </form>
            </div>
            <div class="hdr_obj">
                <?php 
                    if(isset($_SESSION["userLuid"])){
                        echo '<button class="h_btn"><a href="profile.php">Profile</a></button>';
                        echo '<button class="h_btn"><a href="_inc/logout_inc.php">Logout</a></button>';
                    }
                    else{
                        echo '<button class="h_btn"><a href="login.php">Login</a></button>';//z logowaniem z tymi przyciskami można zrobić tak że w zależność czy użytkownik jest zalogowany pojawia się inny przycisk(Profile) -->
                        echo '<button class="h_btn"><a href="signup.php">Register</a></button>';
                    }
                ?>
            </div>
        </header>
