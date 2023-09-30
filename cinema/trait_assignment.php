<html>
    <head>

        <link rel="stylesheet" href="css/style.css">

    </head>
    <?php
        require_once("common.php");
        session_start();
    ?>
     
    <?php  
        if (isset($_POST['user_username'])&&isset($_POST['user_trait'])){
            
        //User pou epilexthike gia na allaksei trait
        $user_username=$_POST['user_username'];

        //Trait pou epilexthike gia ton parapano user
        $user_trait=$_POST['user_trait'];
        

        
        
        $sql = "UPDATE user SET user_trait = '$user_trait' WHERE user_username = '$user_username'";
        $result = $conn->query($sql);
        if(!$sql) echo ("failed").$conn->error."<br><br>";
                else{
                    echo 'Trait successfully updated';
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
