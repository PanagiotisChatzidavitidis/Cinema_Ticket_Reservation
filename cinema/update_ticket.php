<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
    </head>

<?php
    require_once("common.php");
    session_start();

    if (isset($_POST['ticket_number'])) {
        $ticket_number = $_POST['ticket_number'];
        $selected_value = $_POST['ticket_id_edit'];
    
        $query1 = "SELECT * FROM ticket WHERE ticket_id ='$selected_value'"; // select the ticket to get the screening id
        $result1 = $conn->query($query1);
        $row1 = $result1->fetch_assoc();
        $screening_id = $row1['screening_scr_id'];
        $old_ticket_number = $row1['ticket_number'];
    
        $query2 = "SELECT * FROM screening WHERE scr_id ='$screening_id'"; // select the screening to get the capacity
        $result2 = $conn->query($query2);
        $row2 = $result2->fetch_assoc();
        $scr_price = $row2['scr_price']; // price of the screening
        $capacity = $row2['scr_capacity']; // current capacity of the screening
    
        $ticket_total_price = $ticket_number * $scr_price;
    
        // check if new ticket number is greater or smaller than the old ticket number
        if ($ticket_number < $old_ticket_number) {
            // new ticket number is less than the old ticket number, so the difference should be restored to the capacity
            $seats_to_restore = $old_ticket_number - $ticket_number;
            $new_capacity = $capacity + $seats_to_restore;
            $sql_update_capacity = "UPDATE screening SET scr_capacity=$new_capacity WHERE scr_id = '$screening_id'";
            $result4 = $conn->query($sql_update_capacity);
            if (!$result4) {
                echo ("Failed to update screening capacity.") . $conn->error . "<br><br>";
            }
            else{
                echo $selected_value . " has been successfully edited";
            }
        } else if ($ticket_number > $old_ticket_number) {
            // new ticket number is greater than the old ticket number, so the difference should be subtracted from the capacity
            $seats_to_book = $ticket_number - $old_ticket_number;
            if ($capacity >= $seats_to_book) {
                $new_capacity = $capacity - $seats_to_book;
                $sql_update_capacity = "UPDATE screening SET scr_capacity=$new_capacity WHERE scr_id = '$screening_id'";
                $result4 = $conn->query($sql_update_capacity);
                if (!$result4) {
                    echo ("Failed to update screening capacity.") . $conn->error . "<br><br>";
                }else{
                    echo $selected_value . " has been successfully edited";
                }
            } else {
                // there are not enough available seats to book the new tickets
                echo "Not enough available seats for the selected screening.";
            }
        }
    
        // update the ticket with the new number and price
        $sql_update = "UPDATE ticket SET ticket_number=$ticket_number,ticket_total_price=$ticket_total_price WHERE ticket_id = '$selected_value'";
        $result3 = $conn->query($sql_update);

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
