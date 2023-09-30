
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
            <img src="images/popcorn.png" width="200"><div class="title">Cine-Zea</div>
        </header>
            
        <!-- Navigation bar-->    
        <nav class="topnav">
            <!-- redirect to cinemahome-->
            <?php
                if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Admin') {        //if user is admin
                    echo '<a href="admin_cinemahome.php">Home</a>';
                
                }elseif(isset($_SESSION['trait']) && ($_SESSION['trait'] == 'User' || $_SESSION['trait'] == 'Unassigned')) {
                    echo '<a href="cinemahome.php">Home</a>';                                // code for user or unassigned

                }else{                                                                  //if user is not signed in
                    echo '<a href="default_cinemahome.php">Home</a>';
                }
            ?>
            <a href="movies.php">Movies</a>
            <a class="active" href="screenings.php">Screenings</a>

            <?php
                if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Admin') {    //if user is admin
                    echo '<a href="user_administration.php">User Administration</a>';
                    echo '<a href="ticket.php">Ticket Administration</a>';

                }elseif(isset($_SESSION['trait']) && $_SESSION['trait'] == 'User') {
                    echo '<a href="ticket.php">Reserve your ticket</a>';    // if user is user 

                }
        
            
            
                // sing up/in/out
        
                if(!isset($_SESSION['username'])) {                 //if there is no user
                    echo '<a href="cinema_sign_up.php">Sign-up</a>';
                    echo '<a href="cinema_sign_in.php">Sign-in</a>';
                }else{
                    echo '<a href="cinema_sign_out.php">Sign-out</a>';
                }

            ?> 
            
        </nav>    
        <!-- Display Screenings-->
        <div class='title'>Available Screenings</div>

        <form action="" method="get">
            <input type="text" name="search" placeholder="Search by movie name">
            <button type="submit">Search</button>
        </form>

        <?php
            if(isset($_GET['search'])){
                $search_term = $_GET['search'];
                $sql = "SELECT * FROM screening WHERE movie_movie_name LIKE '%$search_term%'";
            } else {
                $sql = 'SELECT * FROM screening';
            }

            $result = $conn->query($sql);

            if (!$result) die($conn->error);

            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $capacity = $row['scr_capacity'];
                if ($row['scr_price'] == 8.00) {
                    echo "<div class='item'><img src='images/screening_icon.png' width=100><br>"."ID: ".$row['scr_id']."<br><br>"."Movie: ".$row['movie_movie_name']."<br><br>"."Hall: ".$row['scr_hall']."<br><br>"."Date&Time: ".$row['scr_date']."<br><br>"."Price: ".$row['scr_price']."€"."<br><br>";
                } else {
                    echo "<div class='item'><img src='images/screening_icon.png' width=100><br>"."ID: ".$row['scr_id']."<br><br>"."Movie: ".$row['movie_movie_name']." 3D"."<br><br>"."Hall: ".$row['scr_hall']."<br><br>"."Date&Time: ".$row['scr_date']."<br><br>"."Price: ".$row['scr_price']."€"."<br><br>";
                }
                if ($capacity > 40) {               //capacity message
                    echo "Many available seats</div>";
                } elseif ($capacity <= 40 && $capacity > 20) {
                    echo "Several available seats</div>";
                } elseif ($capacity <= 20 && $capacity > 0) {
                    echo "Few available seats</div>";
                } else {
                    echo "No available seats</div>";
                }
            }
        ?>
        <?php
            
            //o admin exei oles tis leitourgies diaxeirishs
            if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Admin') {        //admin start
            
        ?> 
        <!-- Insert New movie -->
        <div class='movies'>Insert Screening</div>
            <div class="container">  
                <form action="insert_screening.php" method="post">
                    <div class="row">
                        <div class="col-25">
                            <label for="scr_id">ID</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="scr_id" name="scr_id" placeholder="Enter screening ID code...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="movie_movie_name">Movie</label>
                        </div>
                        <div class="col-75">
                            <select id="movie_movie_name" name="movie_movie_name">
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
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="scr_price">Hall</label>
                        </div>
                        <div class="col-75">
                            <select id="scr_hall" name="scr_hall">
                                <option value="Hall 1">Hall 1</option>
                                <option value="Hall 2">Hall 2</option>
                                <option value="Hall 3">Hall 3</option>
                                <option value="Hall 4">Hall 4</option>
                                <option value="Hall 5">Hall 5</option>
                            </select>
                        </div>
                    </div>                                
                    <div class="row">
                        <div class="col-25">
                            <label for="scr_price">Screening Type</label>
                        </div>
                        <div class="col-75">
                            <select id="scr_price" name="scr_price">
                                <option value=8.00>Regular Sreening: 8.00€</option>
                                <option value=10.00>3D Screening: 10.00€</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="scr_date">Date&Time</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="scr_date" name="scr_date" placeholder="Enter screening Date&Time (Format:yyyy-mm-dd hh:mm)">
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="Insert">
                    </div>
                
                
                </form>
            </div>
        
            <!-- Delete  screening -->
            <div class='movies'>Delete Screening</div>

            <div class="container">
                <form action="delete_screening.php" method="post">
                    <div class="row">
                        <div class="col-25">
                            <label for="scr_id">Select screening to DELETE</label>
                        </div>
                        <div class="col-75">
                            <select id="scr_id" name="scr_id">
                                <?php
                                    $sql='select * from screening';
                                    $result=$conn->query($sql);
                                    if (!$result) die($conn->error);
                                    while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                                        echo "<option value='".$row['scr_id']."'>".$row['scr_id']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="row">
                            <input type="submit" value="Delete">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Update  screening -->
            <div class='movies'>Update Screening</div>
            <div class="container">  
                <form action="update_screening.php" method="post">
                    <div class="row">
                        <div class="col-25">
                            <label for="scr_id">Select screening to Update</label>
                        </div>
                        <div class="col-75">
                            <select id="scr_id" name="scr_id_edit"> <!-- einai i timi pou elexete gia to update -->
                                <?php
                                    $sql='select * from screening';
                                    $result=$conn->query($sql);
                                    if (!$result) die($conn->error);
                                    while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                                    echo "<option value='".$row['scr_id']."'>".$row['scr_id']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="scr_id">ID</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="scr_id" name="scr_id" placeholder="Enter screening ID code...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="movie_movie_name">Movie</label>
                        </div>
                        <div class="col-75">
                            <select id="movie_movie_name" name="movie_movie_name">
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
                                <label for="scr_price">Hall</label>
                            </div>
                            <div class="col-75">
                                <select id="scr_hall" name="scr_hall">
                                    <option value="Hall 1">Hall 1</option>
                                    <option value="Hall 2">Hall 2</option>
                                    <option value="Hall 3">Hall 3</option>
                                    <option value="Hall 4">Hall 4</option>
                                    <option value="Hall 5">Hall 5</option>
                                </select>
                            </div>
                        </div>                                
                        <div class="row">
                            <div class="col-25">
                                <label for="scr_price">Screening Type</label>
                            </div>
                            <div class="col-75">
                                <select id="scr_price" name="scr_price">
                                    <option value=8.00>Regular Sreening: 8.00€</option>
                                    <option value=10.00>3D Screening: 10.00€</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="scr_date">Date&Time</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="scr_date" name="scr_date" placeholder="Enter screening Date&Time (Format:yyyy-mm-dd hh:mm)">
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" value="Update">
                        </div>
                    </div>
                            
                </form>
            </div>
            </div>  
            
            <?php
                }       //admin end
            ?>
            <footer>
                Copyright
            </footer>

    </body>
<html>