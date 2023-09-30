<html>
    <head>

    <link rel="stylesheet" href="css/style.css">

    </head>
    <?php
        require_once("common.php");
        session_start();
    ?>
     
    <?php    
        $selected_value = $_POST['ticket_id'];          //dropbox 
        $sql = "SELECT * FROM ticket WHERE ticket_id = '$selected_value'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $screening_id = $row['screening_scr_id'];
        $ticket_number = $row['ticket_number'];
        
        $sql_delete = "DELETE FROM ticket WHERE ticket_id = '$selected_value'";
        $result_delete = $conn->query($sql_delete);
                
        if (!$sql_delete) {
            echo "Failed to delete ticket: " . $conn->error;
        } else {
            echo $selected_value . " successfully deleted";
            
            $sql_screening = "SELECT * FROM screening WHERE scr_id = '$screening_id'";
            $result_screening = $conn->query($sql_screening);
            $row_screening = $result_screening->fetch_assoc();
            $current_capacity = $row_screening['scr_capacity'];
            
            $new_capacity = $current_capacity + $ticket_number; //restored seats
            $sql_update_screening = "UPDATE screening SET scr_capacity = $new_capacity WHERE scr_id = '$screening_id'";  //update capacity 
            $result_update_screening = $conn->query($sql_update_screening);
            
            if (!$result_update_screening) {
                echo "Failed to update screening capacity: " . $conn->error;
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
