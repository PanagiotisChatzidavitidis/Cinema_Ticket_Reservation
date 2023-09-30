<html>
    <head>

    <link rel="stylesheet" href="css/style.css">

    </head>
    <?php
        require_once("common.php");
        session_start();
    ?>
        
    <?php    

        $selected_value = $_POST['movie_name'];
        $sql = "DELETE FROM movie WHERE movie_name = '$selected_value'";
        $result = $conn->query($sql);
                
        if(!$sql) echo ("failed").$conn->error."<br><br>";
        
        else{
            echo $selected_value."succefully deleted";
        }

    
        
        
    ?>
    <div class="container">
        <form action="movies.php" method="post">
        
            <div class="row">
                <input type="submit" value="Continue">
            </div>
        </form>
    </div>
</html>
