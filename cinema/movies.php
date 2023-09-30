
<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <?php
            require_once("common.php");
            session_start();
        
        ?>
    </head>
    
    <body>

        <header>
            <img src="images/popcorn.png" width="200"><div class="title">Cine-Zea </div>
        </header>
      

        <!-- Navigation bar-->
        <nav class="topnav">
            <!-- redirect to cinemahome-->
            <?php
                if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Admin') {        //if user is admin
                    echo '<a href="admin_cinemahome.php">Home</a>';
                 
                }elseif(isset($_SESSION['trait']) && ($_SESSION['trait'] == 'User' || $_SESSION['trait'] == 'Unassigned')) {
                    echo '<a href="cinemahome.php">Home</a>';                                //if user is user or unassigned

                }else{                                                                  //if user is not signed in
                    echo '<a href="default_cinemahome.php">Home</a>';
                }
            ?>


            <a class="active" href="movies.php">Movies</a>
            <a href="screenings.php">Screenings</a>

            <?php
               
                if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Admin') {
                    echo '<a href="user_administration.php">User Administration</a>';       //if user is admin
                    echo '<a href="ticket.php">Ticket Administration</a>';
                 
                }elseif(isset($_SESSION['trait']) && $_SESSION['trait'] == 'User') {
                    echo '<a href="ticket.php">Reserve your ticket</a>';    // if user is user 

                }
        
            //sign up/in/out
          
                if(!isset($_SESSION['username'])) {
                    echo '<a href="cinema_sign_up.php">Sign-up</a>';
                    echo '<a href="cinema_sign_in.php">Sign-in</a>';
                }else{
                    echo '<a href="cinema_sign_out.php">Sign-out</a>';
                }
                 
                
            ?>   
                
        </nav>

        <!-- Display Movies-->
        <div class='title'>Now Playing</div>
        <div class='movies'>Genre</div>
        

        <?php
            // Get all available genres
            $sql_genres = 'SELECT DISTINCT movie_genre FROM movie';
            $result_genres = $conn->query($sql_genres);

            if (!$result_genres) die($conn->error);
            $genres = array();
            while ($row_genres = $result_genres->fetch_array(MYSQLI_ASSOC)){
                $genres[] = $row_genres['movie_genre'];
            }

            // Check if genre filter is set
            if (isset($_GET['genre']) && $_GET['genre'] != '') {
                $genre_filter = $_GET['genre'];
                $sql_movies = "SELECT * FROM movie WHERE movie_genre = '$genre_filter'";
            } else {
                $sql_movies = "SELECT * FROM movie";
            }
            $result_movies = $conn->query($sql_movies);

            if (!$result_movies) die($conn->error);

            // Display genre filter options
            echo "<form method='get'>";
            echo "<select name='genre' onchange='this.form.submit()'>";
            echo "<option value=''>All Genres</option>";
            foreach ($genres as $genre) {
                if ($genre == $genre_filter) {
                    echo "<option value='$genre' selected>$genre</option>";
                } else {
                    echo "<option value='$genre'>$genre</option>";
                }
            }
            echo "</select>";
            echo "</form>";

            // Display available movies
            while ($row_movies = $result_movies->fetch_array(MYSQLI_ASSOC)){
                echo "<div class='item'><img src='images/movie_icon.png' width=100><br>"
                    ."Title: ".$row_movies['movie_name']."<br><br>"
                    ."Genre: ".$row_movies['movie_genre']."<br><br>"
                    ."Duration: ".$row_movies['movie_duration']."<br><br>"
                    ."Description: ".$row_movies['movie_descr']."<br>"
                    ."</div>";
            }
        ?>
         
            
        <?php
            
            //an to trait einai admin tote exei oles tis leitourgies diaxeirishs
            if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Admin') {
        ?>
            <!-- Insert New movie -->
            <div class='movies'>Insert Movie</div>   
            <div class="container">  
            <form action="insert_movie.php" method="post">
                <div class="row">
                <div class="col-25">
                    <label for="movie_name">Title</label>
                </div>
                <div class="col-75">
                    <input type="text" id="movie_name" name="movie_name" placeholder="Enter movie title...">
                </div>
                </div>
                <div class="row">
                <div class="col-25">
                    <label for="movie_descr">Description</label>
                </div>
                <div class="col-75">
                    <textarea id="movie_descr" name="movie_descr" placeholder="Enter Description.." style="height:200px"></textarea>
                </div>
                </div>
                
                <div class="row"> 
                <div class="col-25">
                    <label for="movie_genre">Genre</label>
                </div>
                <div class="col-75">
                    <input type="text" id="movie_genre" name="movie_genre" placeholder="Enter genre...">
                </div>
                </div>
                <div class="row">
                <div class="col-25">
                    <label for="movie_duration ">Duration </label>
                </div>
                <div class="col-75">
                    <input type="text" id="movie_duration" name="movie_duration" placeholder="Enter movie duration...">
                </div>
                </div>
                <div class="row">
                    <input type="submit" value="Insert">
                </div>
            
            
            </form>
            </div>
            
            
            <!-- Delete  movie -->
            <div class='movies'>Delete movie</div>
            <div class="container">
            <form action="delete_movie.php" method="post">
                    <div class="row">
                    <div class="col-25">
                        <label for="movie_movie_name">Select Movie to DELETE</label>
                    </div>
                    <div class="col-75">
                            <select id="movie_name" name="movie_name">
                            <?php
                                $sql='select * from movie';
                                $result=$conn->query($sql);
                                if (!$result) die($conn->error);
                                while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                                    echo "<option value='".$row['movie_name']."'>".$row['movie_name']."</option>";
                                }
                            ?>
                            </select>
                    </div>
                    <div class="row">
                    <input type="submit" value="Delete">
                    </div>
            </form>
            </div>
            </div>

            
                <!-- Update  movie -->
            <div class='movies'>Update movie</div>
            <div class="container">  
        
            <form action="update_movie.php" method="post">
                <div class="row">
                <div class="col-25">
                    <label for="movie_name">Select Movie to EDIT</label>
                </div>
                <div class="col-75">
                            <select id="movie_name" name="movie_name_edit"> <!-- einai i timi pou elexete gia to update -->
                            <?php
                                $sql='select * from movie';
                                $result=$conn->query($sql);
                                if (!$result) die($conn->error);
                                while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                                    echo "<option value='".$row['movie_name']."'>".$row['movie_name']."</option>";
                                }
                            ?>
                            </select>
                    </div>
            
                <div class="row">
                <div class="col-25">
                    <label for="movie_name">Title</label>
                </div>
                <div class="col-75">
                    <input type="text" id="movie_name" name="movie_name" placeholder="Enter movie title...">
                </div>
                </div>
                <div class="row">
                <div class="col-25">
                    <label for="movie_descr">Description</label>
                </div>
                <div class="col-75">
                    <textarea id="movie_descr" name="movie_descr" placeholder="Enter Description.." style="height:200px"></textarea>
                </div>
                </div>
                
                <div class="row"> 
                <div class="col-25">
                    <label for="movie_genre">Genre</label>
                </div>
                <div class="col-75">
                    <input type="text" id="movie_genre" name="movie_genre" placeholder="Enter genre...">
                </div>
                </div>
                <div class="row">
                <div class="col-25">
                    <label for="movie_duration ">Duration </label>
                </div>
                <div class="col-75">
                    <input type="text" id="movie_duration" name="movie_duration" placeholder="Enter movie duration...">
                </div>
                </div>
                <div class="row">
                    <input type="submit" value="Update">
                </div>
            </form>
            </div>

        <?php
            }
        ?>
        
        <footer>
            Copyright
        </footer>

     
    
    </body>
<html>

