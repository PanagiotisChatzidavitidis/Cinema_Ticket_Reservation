<html>
    <head>

        <link rel="stylesheet" href="css/style.css">

    </head>
    <?php
        session_start();
        session_unset();

        require_once("common.php");
    ?>
     
    <?php 
        echo "<br>Successfully Signed-out!<br>";
       
    ?>


    <div class="container">
        <form action="default_cinemahome.php" method="post">
            <div class="row">
                <input type="submit" value="Continue">
            </div>
        </form>
    </div>

    
</html>