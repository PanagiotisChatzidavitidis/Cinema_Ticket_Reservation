<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <?php
        session_start();
        $username = $_SESSION['username'];
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
            <?php   //welcome message

            if(!empty($username)){
                echo"Welcome $username!";
                if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Unassigned'){
                    echo"<br>Your account has not been activated yet, please check again shortly<br>";
                }
            }
            
        ?>
        
        </header>

        <div class="topnav">    <!--top navigation (user is already sign in)-->

            <a class="active" href="cinemahome.php">Home</a>
            <a href="movies.php">Movies</a>
            <a href="screenings.php">Screenings</a>  

            
            <?php
                if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'User') {        //if user is user
                    echo '<a href="ticket.php">Reserve your ticket</a>';
        
                }
            ?>                                              
            <!-- Unassigned users cannot reserve tickets-->

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
    