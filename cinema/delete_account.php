<html>
    <head>

        <link rel="stylesheet" href="css/style.css">

    </head>
    <?php
        require_once("common.php");
        session_start();
    ?>
    <?php    

        $selected_value = $_POST['user_username'];
        $sql = "DELETE FROM user WHERE user_username = '$selected_value'";
        $result = $conn->query($sql);

        if(!$sql) echo ("failed").$conn->error."<br><br>";

        else{
            echo $selected_value."User succefully deleted";
        }

    ?>
    <div class="container">
        <form action="user_administration.php" method="post">

            <div class="row">
                <input type="submit" value="Continue">
            </div>
        </form>
    </div>
<html>