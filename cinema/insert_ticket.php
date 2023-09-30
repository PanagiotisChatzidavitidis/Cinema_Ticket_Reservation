<html>
    <head>

        <link rel="stylesheet" href="css/style.css">

    </head>
    <?php
            require_once("common.php");
            session_start();
    ?>

    <?php 
        if (isset($_POST['user_user_username']) && isset($_POST['screening_scr_id']) && isset($_POST['ticket_number'])) {
            $user_user_username = $_POST['user_user_username'];
            $screening_scr_id = $_POST['screening_scr_id'];
            $ticket_number = $_POST['ticket_number'];

            $query = "SELECT * FROM screening WHERE scr_id ='$screening_scr_id'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $capacity = $row['scr_capacity'];
            $cost = $row['scr_price'];

            
            if (empty($user_user_username) || empty($screening_scr_id) || empty($ticket_number)) {
                echo "Please fill in all fields.";
                
            }else{
                $ticket_total_price = $ticket_number * $cost;
                // Check if there is enough capacity to reserve the tickets
                if ($ticket_number > $capacity) {
                    echo "Your request can't be served because there are only $capacity seats left.";
                } else {
                    // Generate ticket ID using current timestamp
                    $ticket_id = time();
                    
                    $sql = "INSERT INTO ticket(ticket_id, user_user_username, user_cinema_cinema_name, ticket_number, ticket_total_price, screening_scr_id) VALUES ('$ticket_id','$user_user_username',NULL,$ticket_number,$ticket_total_price,'$screening_scr_id')";
                    $result1 = $conn->query($sql);

                    if (!$result1) {
                        echo "failed" . $conn->error . "<br><br>";
                    } else {
                        // Subtract the number of reserved tickets from the screening capacity
                        $update_capacity_query = "UPDATE screening SET scr_capacity = scr_capacity - $ticket_number WHERE scr_id = '$screening_scr_id'";
                        $result2 = $conn->query($update_capacity_query);
                        
                        if (!$result2) {
                            echo "failed" . $conn->error . "<br><br>";
                        } else {
                            echo "Successfully booked";
                        }
                    }
                }
            }
        }
    ?> 






       

    <div class="container">
        <form action="ticket.php" method="post">
        
            <div class="row">
                <input type="submit" value="Continue">
            </div>
        </form>
    </div>
</html>
