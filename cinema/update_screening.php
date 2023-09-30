<html>
    <head>

     <link rel="stylesheet" href="css/style.css">

    </head>
<?php
        require_once("common.php");
        session_start();
        ?>
     
     <?php    
        if (isset($_POST['scr_id'])&&isset($_POST['scr_hall'])&&isset($_POST['scr_date'])&&isset($_POST['scr_price'])&&isset($_POST['movie_movie_name'])){
            $scr_id=$_POST['scr_id'];
            $scr_hall=$_POST['scr_hall'];
            $scr_date=$_POST['scr_date'];
            $scr_price=$_POST['scr_price'];
            $movie_movie_name=$_POST['movie_movie_name'];


            $selected_value = $_POST['scr_id_edit'];
            $sql = "UPDATE screening SET scr_id='$scr_id', scr_hall='$scr_hall',scr_date='$scr_date',scr_price='$scr_price', movie_movie_name='$movie_movie_name' WHERE scr_id = '$selected_value'";
            
            $result = $conn->query($sql);
                    
            if(!$sql) echo ("failed").$conn->error."<br><br>";
            else{
                echo $selected_value."succefully updated";
            }
        }
    ?>
    <div class="container">
        <form action="screenings.php" method="post">
        
            <div class="row">
                <input type="submit" value="Continue">
            </div>
        </form>
    </div>
</html>
