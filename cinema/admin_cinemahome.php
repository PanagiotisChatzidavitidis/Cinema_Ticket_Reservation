<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <?php
        session_start();
  
    ?>
    <body>
        <header>
            <img src="images/popcorn.png" width="200"><div class="title">Cine-Zea</div>
            <div class="info">
                <div>
                Monday-Friday<br>12:00-1:00 
                </div>
                <div>
                    Saturday-Sunday<br>
                    12:00-3:00
                </div>
            </div>
            <div class="phone">
                <div>
                    Phone:2104413999<br>Zeas 25
                </div>
            </div>
            <?php 
            
                $username = $_SESSION['username'];
                echo"Welcome $username!";
            ?>
        </header>

        <div class="topnav">
            <a class="active" href="admin_cinemahome.php">Home</a>
            <a href="movies.php">Movies</a>
            <a href="screenings.php">Screenings</a>
            <a href="user_administration.php">User Administration</a>
            <a href="ticket.php">Ticket Administration</a>
            <a href="cinema_sign_out.php">Sign-out</a>
        
        </div>
        <div class="slides slowFade">
            <div class="slide">
                <img src="images/seats1.jpg" alt="img"/>
            </div>
            <div class="slide">
                <img src="images/cinema3.jpg" alt="img"/>
            </div>
            <div class="slide">
                <img src="images/cinema1.jpg" alt="img"/>
            </div>
            <div class="slide">
                <img src="images/cinema2.jpg" alt="img"/>
            </div>
        </div>
        

        <footer>
            Copyright
        </footer>
        
    </body>
</html>
    