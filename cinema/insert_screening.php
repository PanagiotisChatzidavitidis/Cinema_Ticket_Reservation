<html>
    <head>

        <link rel="stylesheet" href="css/style.css">
        <?php
            require_once("common.php");
            session_start();
        ?>
    </head>
    <?php 
        if (isset($_POST['scr_id'])&&isset($_POST['scr_hall'])&&isset($_POST['scr_date'])&&isset($_POST['scr_price'])&&isset($_POST['movie_movie_name'])){
            $scr_id=$_POST['scr_id'];
            $scr_hall=$_POST['scr_hall'];
            $scr_capacity=100;
            $scr_date=$_POST['scr_date'];
            $scr_price=$_POST['scr_price'];
            $movie_movie_name=$_POST['movie_movie_name'];
            
            $sql="INSERT into screening values('$scr_id', '$scr_hall', '$scr_capacity', '$scr_date','$scr_price','$movie_movie_name')";
            $result = $conn->query($sql);
            
            if(!$sql) echo ("failed").$conn->error."<br><br>";
            
            else{
                echo "succefully inserted";
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

<html>