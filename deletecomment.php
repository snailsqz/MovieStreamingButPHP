<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/login.css" />
        <title>deletecomment</title>
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

            $review_id = $_GET['review_id'];
            
            $sqlmovie = "SELECT movie_id FROM reviews WHERE review_id = $review_id";
            $resultmovie_ID = mysqli_query ($conn, $sqlmovie);
            $rs = mysqli_fetch_array($resultmovie_ID);
            $sql = "DELETE FROM reviews WHERE review_id = $review_id";
            $result = mysqli_query($conn, $sql);
            
            header("Location: movie.php?movie_id=$rs[0]");
        ?>
    </body>
</html>
