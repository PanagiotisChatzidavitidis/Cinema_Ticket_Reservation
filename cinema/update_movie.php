<html>
    <head>

        <link rel="stylesheet" href="css/style.css">

    </head>
    <?php
        require_once("common.php");
        session_start();
    ?>
     
    <?php    
        if (isset($_POST['movie_name'])&&isset($_POST['movie_descr'])&&isset($_POST['movie_genre'])&&isset($_POST['movie_duration'])){
            $movie_name=$_POST['movie_name'];
            $movie_descr=$_POST['movie_descr'];
            $movie_genre=$_POST['movie_genre'];
            $movie_duration=$_POST['movie_duration'];
            $cinema_cinema_name="Cine-Zea";


            $selected_value = $_POST['movie_name_edit'];
            $sql = "UPDATE movie SET movie_name='$movie_name',movie_descr='$movie_descr',movie_genre='$movie_genre',movie_duration='$movie_duration',cinema_cinema_name='Cine-Zea' WHERE movie_name = '$selected_value'";
            
            $result = $conn->query($sql);
                    
            if(!$sql) echo ("failed").$conn->error."<br><br>";
            else{
                echo $selected_value."succefully updated";
            }
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
