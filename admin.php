<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/login.css" />
        <title>login</title>
    </head>
    <body>
        <?php
            session_start();
            $checkLogin = 1;
            if (!isset($_SESSION['User_role'])){
              $checkLogin = 0;
              header("Location: index.php");
            }
            if(isset($_SESSION['User_role']) && $_SESSION['User_role'] == 'User') {
              header("Location: index.php");
            }
        ?>
        <?php
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $dbName = "streaming";
            $conn = mysqli_connect($hostname, $username, $password);
            if (!$conn) {
                    die("Fail to connect");
            }
            mysqli_select_db($conn, $dbName) or die("Can't Choose db");
            mysqli_query($conn, "set character_set_connection=utf8mb4");
            mysqli_query($conn, "set character_set_client=utf8mb4");
            mysqli_query($conn, "set character_set_results=utf8mb4");

            $user_id = $_GET['user_id'];
            $checkrole = "SELECT roles FROM user WHERE user_id = $user_id";
            $resultrole = mysqli_query($conn, $checkrole);
            $roles = "";
            while($row = mysqli_fetch_assoc($resultrole)){
                $roles = $row['roles'];
            }
            
            if($roles == 'Admin'){
                $sql = "UPDATE user SET roles = 'User' WHERE user_id = $user_id";
                $result = mysqli_query($conn, $sql);
                header("Location: dashboardusers.php");
            }
            else if($roles == 'User'){
                $sql = "UPDATE user SET roles = 'Admin' WHERE user_id = $user_id";
                $result = mysqli_query($conn, $sql);
                header("Location: dashboardusers.php"); 
            }
            header("Location: dashboardusers.php");
            
            mysqli_close($conn);
        ?>
    </body>
</html>
