<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/login.css" />
        <title>deleteuser</title>
    </head>
    <body>
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

                session_start();
                $userSessionId = $_SESSION['User_id'];
                $userSessionImage = $_SESSION['User_Image'];
                $user_id = $_GET['user_id'];
                
                $sql = "DELETE FROM user WHERE user_id = $user_id";
                $result = mysqli_query($conn, $sql);
                if($userSessionImage != "noimage.jpg"){
                    $imagePath = "image/$userSessionImage";
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                if($userSessionId == $user_id){
                    unset($_SESSION["Username"]);
                    unset($_SESSION["User_id"]);
                    unset($_SESSION["User_Image"]);
                    header("Location: index.php");
                }
                else{
                    header("Location: dashboardusers.php");
                }
        ?>
    </body>
</html>
