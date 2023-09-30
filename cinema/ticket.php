
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
                 
                }elseif(isset($_SESSION['trait']) && $_SESSION['trait'] == 'User') {
                    echo '<a href="cinemahome.php">Home</a>';                           // if user is user

                }
            ?>
            <a href="movies.php">Movies</a>
            <a href="screenings.php">Screenings</a> 
            
            <!-- redirect to cinemahome-->
            <?php
                if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Admin') {            //if user is admin
             
                    echo '<a href="user_administration.php">User Administration</a>';
                    echo '<a class="active" href="ticket.php">Ticket Administration</a>';
                 
                }elseif(isset($_SESSION['trait']) && $_SESSION['trait'] == 'User') {
                    echo '<a class="active" href="ticket.php">Reserve your ticket</a>';    // if user is user 

                }
            ?>
            <a href="cinema_sign_out.php">Sign-out</a> 

        </nav>

        <!-- ADMIN TICKETS-->        
        <?php
            if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Admin') {            //if user is admin
        ?>
       
        <!-- Display Ticket History-->
        <div class='movies'>Ticket History</div> 
                
        <form method="post">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit" name="submit">Search</button>
        </form>
        <div class="container">
            <?php
                if(isset($_POST['submit'])){        //search bar
                    $search = $_POST['search'];
                    $sql="SELECT * FROM ticket WHERE (ticket_id LIKE '%$search%' OR user_user_username LIKE '%$search%' OR ticket_number LIKE '%$search%' OR ticket_total_price LIKE '%$search%' OR screening_scr_id LIKE '%$search%')";
                } else {
                    $sql="SELECT * FROM ticket";
                }
                $result=$conn->query($sql);
                if (!$result) die($conn->error);
                while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                    echo "<div class='item'><br>"."Ticket ID: ".$row['ticket_id']." | "."Username: ".$row['user_user_username']." | "."Number of Tickets: ".$row['ticket_number']." | "."Total Price: ".$row['ticket_total_price']."€ | "."Screening ID: ".$row['screening_scr_id']."<br></div>";
                }
            ?>
        </div>
        

         
        <!-- Insert New Ticket -->
        <div class='movies'>Insert New Ticket</div>   
        <div class="container">  
            <form action="insert_ticket.php" method="post">
                
                <div class="row">
                    <div class="col-25">
                        <label for="user_user_username">Username</label>
                    </div>
                    <div class="col-75">
                        <select id="user_user_username" name="user_user_username"> <!-- einai to username pou epilegetai -->
                            <?php
                                $sql='select * from user where user_trait="User"';      
                                $result=$conn->query($sql);
                                if (!$result) die($conn->error);
                                while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                                    echo "<option value='".$row['user_username']."'>".$row['user_username']."</option>";    //username dropbox
                                }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="row"> 
                    <div class="col-25">
                        <label for="ticket_number">Number of tickets</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="ticket_number" name="ticket_number" placeholder="Enter Number of tickets...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="screening_scr_id">Select Screening</label>
                    </div>
                    <div class="col-75">
                        <select id="screening_scr_id" name="screening_scr_id"> <!-- einai to screening pou epilegetai -->
                            <?php
                                $sql='select * from screening';
                                $result=$conn->query($sql);
                                if (!$result) die($conn->error);
                                while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                                    echo "<option value='".$row['scr_id']."'>".$row['scr_id']."</option>";      //screening id dropbox
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" value="Insert">
                </div>
            
            
            </form>
        </div>
        
         <!-- Delete  movie -->
         <div class='movies'>Delete Ticket</div>
         <div class="container">
            <form action="delete_ticket.php" method="post">
                    <div class="row">
                        <div class="col-25">
                            <label for="ticket_id">Select ticket to DELETE</label>
                        </div>
                        <div class="col-75">
                            <select id="ticket_id" name="ticket_id">
                                <?php
                                    $sql='select * from ticket';
                                    $result=$conn->query($sql);
                                    if (!$result) die($conn->error);
                                    while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                                        echo "<option value='".$row['ticket_id']."'>".$row['ticket_id']."</option>"; //ticket id dropbox
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="Delete">
                    </div>
            </form> 
         </div>
        

        
        <!-- Update  ticket -->
        <div class='movies'>Update ticket reservation</div>
        <div class="container">  
       
            <form action="update_ticket.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="ticket_id">Select Ticket to EDIT</label>
                    </div>
                    <div class="col-75">
                        <select id="ticket_id" name="ticket_id_edit"> <!-- einai to ticket pou tha dextei epeksergasia -->
                            <?php
                                $sql='select * from ticket';
                                $result=$conn->query($sql);
                                if (!$result) die($conn->error);
                                while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                                    echo "<option value='".$row['ticket_id']."'>".$row['ticket_id']."</option>";        //ticket dropbox
                                }
                            ?>
                        </select>
                    </div>
                </div>   

                <div class="row"> 
                    <div class="col-25">
                        <label for="ticket_number">Number of tickets</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="ticket_number" name="ticket_number" placeholder="Enter Number of tickets...">
                    </div>
                </div>
                <div class="row">
                    <input type="submit" value="Update">
                </div>
            
            
            </form>
        </div>
        
        <?php
            }elseif (isset($_SESSION['trait']) && $_SESSION['trait'] == 'User'){ //if user is user
        ?>

        <!-- USER TICKETS-->                                                   

        <!-- Display tickets for Current User-->
        <div class='movies'>Your History</div>   
        <?php
            $current_user=$_SESSION['username'];
            $sql="SELECT * FROM ticket where user_user_username='$current_user'";
            $result=$conn->query($sql);
            if (!$result) die($conn->error);
            while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                echo "<div class='item'><br>"."ID: ".$row['ticket_id']." | "."Username: ".$row['user_user_username']." | "."Number of Tickets: ".$row['ticket_number']." | "."Total Price: ".$row['ticket_total_price']."€ | "."Screening ID: ".$row['screening_scr_id']."<br></div>";
            }
        ?>
        
        <!-- User ticket reservation-->
        <div class='movies'>Ticket Reservation</div>   
        <div class="container">  
            <form action="ticket_reservation.php" method="post"> 
                <div class="row"> 
                    <div class="col-25">
                        <label for="ticket_number">Number of tickets</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="ticket_number" name="ticket_number" placeholder="Enter Number of tickets...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="screening_scr_id">Select Screening</label>
                    </div>
                    <div class="col-75">
                            <select id="screening_scr_id" name="screening_scr_id"> <!-- einai to screening p epilegetai -->
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
                    <input type="submit" value="Reserve">
                </div>
            
            
            </form>
        </div>
        <?php 
            } //user end
        ?>

        <footer>
            Copyright
        </footer>

     
    
</body>
<html>

