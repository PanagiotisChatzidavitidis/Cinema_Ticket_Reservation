<html>
    <head>

        <link rel="stylesheet" href="css/style.css">
    </head>
    <?php
        require_once("common.php");
        session_start();
    ?>
     
    <?php     
        if (isset($_POST['user_username'])&&isset($_POST['user_name'])&&isset($_POST['user_lastname'])&&isset($_POST['user_country'])&&isset($_POST['user_city'])&&isset($_POST['user_address'])&&isset($_POST['user_email'])&&isset($_POST['user_password'])){

            $user_username=$_POST['user_username'];//new username
            $user_name=$_POST['user_name'];
            $user_lastname=$_POST['user_lastname'];
            $user_country=$_POST['user_country'];
            $user_city=$_POST['user_city'];
            $user_address=$_POST['user_address'];
            $user_email=$_POST['user_email'];
            $user_password=$_POST['user_password'];
            $cinema_cinema_name="Cine-Zea";
            $user_trait=$_POST['user_trait'];

            $selected_value = $_POST['user_username_edit'];//old selected username
           if (empty($user_username) || empty($user_name) || empty($user_lastname) || empty($user_country) || empty($user_city) || empty($user_address) || empty($user_email) || empty($user_password) || empty($_POST["confirm_password"])) {
                echo "Please fill in all fields.";
            }else{
            
            $query = "SELECT * FROM user WHERE user_username = '$user_username'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                
                echo "Username already exists. Please choose a different username.";
            } else {
                $sql = "UPDATE user SET user_username='$user_username',user_password='$user_password',user_name='$user_name',user_lastname='$user_lastname',user_country='$user_country',user_city='$user_city',user_address='$user_address',user_email='$user_email',cinema_cinema_name='Cine-Zea',user_trait='$user_trait' WHERE user_username='$selected_value'";
                $result = $conn->query($sql);
                if(!$sql) echo ("failed").$conn->error."<br><br>";
                else{
                    echo $selected_value." succefully updated";
                }
            }
        }
    }
    ?>
            <div class="container">
                <form action="user_administration.php" method="post">
                
                    <div class="row">
                        <input type="submit" value="Continue">
                    </div>
                </form>
            </div>
</html>
