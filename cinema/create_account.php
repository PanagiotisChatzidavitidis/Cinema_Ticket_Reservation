<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <?php
        require_once("common.php");
        session_start();
        
    ?>
    
    <?php 
        if (isset($_POST['user_username'])&&isset($_POST['user_name'])&&isset($_POST['user_lastname'])&&isset($_POST['user_country'])&&isset($_POST['user_city'])&&isset($_POST['user_address'])&&isset($_POST['user_email'])&&isset($_POST['user_password'])&&isset($_POST['confirm_password'])){
        
            $user_username=$_POST['user_username'];
            $user_name=$_POST['user_name'];
            $user_lastname=$_POST['user_lastname'];
            $user_country=$_POST['user_country'];
            $user_city=$_POST['user_city'];
            $user_address=$_POST['user_address'];
            $user_email=$_POST['user_email'];
            $user_password=$_POST['user_password'];
            $cinema_cinema_name="Cine-Zea";
            $user_trait="Unassigned";
           




            if (empty($user_username) || empty($user_name) || empty($user_lastname) || empty($user_country) || empty($user_city) || empty($user_address) || empty($user_email) || empty($user_password) || empty($_POST["confirm_password"])) {
                echo "Please fill in all fields.";
                
            }else{  //check if password confirmation is the same as password
                if ($_POST["confirm_password"] !== $user_password){
                       
                    echo "Passwords do not match";
                    
                }else{
                    // Check if the username already exists in the database
                    $query = "SELECT * FROM user WHERE user_username = '$user_username'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        echo "Username already exists. Please choose a different username.";
                    } else {
                        // If the username is not already in use, insert the new user into the database
                        $sql = "INSERT into user values('$user_username','$user_password', '$user_name', '$user_lastname', '$user_country','$user_city','$user_address','$user_email','$cinema_cinema_name','$user_trait')";
                        $result = $conn->query($sql);
                        if (!$sql) {
                            echo ("failed").$conn->error."<br><br>";
                        } else {
                            
                            if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Admin') {        //admin creates an account for a user

                                echo "<br>Account created successfully<br>";

                            }elseif(!isset($_SESSION['trait'])){                                    //user creates account 
                                
                                echo "<br>You succefully created your account!<br>
                                <br>Your account will be activated by an administrator shortly!<br>
                                <br>Check again later!<br>";
                          
                            }
                

                        }
                    }   
            
                } 
            }
        }
    ?>


    <div class="container">
            <?php //elegxos trait gia swsth anakateu8ynsh depending on user trait
                if(isset($_SESSION['trait']) && $_SESSION['trait'] == 'Admin') {
                    $form_action = 'user_administration.php';
                }elseif(!isset($_SESSION['trait'])){
                    $form_action = 'default_cinemahome.php';
              
                }
            ?>
        <form action="<?php echo $form_action?>" method="post">
            <div class="row">
                <input type="submit" value="Continue">
            </div>
        </form>
    </div>
</html>