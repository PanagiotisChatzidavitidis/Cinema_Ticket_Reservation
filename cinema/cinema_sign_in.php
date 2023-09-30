<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <?php
            session_start();
            require_once("common.php");
      
        ?>
        
    </head>
    
    <body>
         <header>
            <img src="images/popcorn.png" width="200"><div class="title">Cine-Zea</div>
        </header>
        <!-- Navigation bar-->
        <nav class="topnav">
             <!-- redirect to cinemahome-->
             <?php
                if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Admin') {        //if user is admin
             
                    
                    echo '<a href="admin_cinemahome.php">Home</a>';
                 
                }elseif(isset($_SESSION['trait']) && ($_SESSION['trait'] == 'User' || $_SESSION['trait'] == 'Unassigned')) {
                    echo '<a href="cinemahome.php">Home</a>';                                // if user is user or unassigned

                }else{                                                                  //if user is not signed in
                    echo '<a href="default_cinemahome.php">Home</a>';
                }
            ?>
            <a href="movies.php">Movies</a>
            <a href="screenings.php">Screenings</a>
            <a href="cinema_sign_up.php">Sign-up</a>
            <a class="active" href="cinema_sign_in.php">Sign-in</a>
        </nav>

        <!--Insert new user-->
        <div class='movies'>Sign In</div>  
        <div class="container">  
            <form action="cinema_sign_in.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <!--username-->
                        <label for="user_username">Username</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user_username" name="user_username" placeholder="Enter Username...">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <!--password-->
                        <label for="user_password">Password</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="user_password" name="user_password" placeholder="Enter Password...">
                    </div>
                </div>
                <!-- sign in button --> 
                <div class="row">
                    <input type="submit" value="Sign In">
                    
                </div>
            </form>

        </div>

        <?php 
            if (isset($_POST['user_username']) && isset($_POST['user_password'])){
                $user_username = $_POST['user_username'];
                $user_password = $_POST['user_password'];
        
                //check if username and password exist in database
                $query = "SELECT * FROM user WHERE user_username ='$user_username' AND user_password='$user_password'";
                $result = $conn->query($query);
        
                if (!$query) {
                    echo ("failed").$conn->error."<br><br>";
                } else {
                    if ($result->num_rows == 0) { //if username or password don't match 
                        echo "Username or Password is not correct. Please try again.";
                    } else { //if username and password match
                        $_SESSION['username'] = $_POST['user_username'];
                        $username = $_SESSION['username']; 
                        $row = $result->fetch_assoc();

                        $_SESSION['trait'] = $row['user_trait'];
                        echo "The trait value of the user is: " . $_SESSION['trait'];
                        
                        if( $_SESSION['trait']=="Admin"){
                            header("Location: admin_cinemahome.php");
                        }else{
                            header("Location:cinemahome.php");
                        }
                    }
                }
            } 

        ?>

       
    </body>
    <footer>
        Copyright
    </footer>
</html>
