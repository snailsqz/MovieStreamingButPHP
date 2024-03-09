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

            $movie_id = $_GET['movie_id'];
            
            $sqlpicture = "SELECT picture FROM movies WHERE movie_id = $movie_id";
            $movie_picture = mysqli_query($conn, $sqlpicture);
            if ($movie_picture) {
                $row = mysqli_fetch_assoc($movie_picture);
                $picture = $row['picture'];
                if ($picture != "noimage2.jpg") {
                    $imagePath = "image/$picture";
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
            $sql = "DELETE FROM movies WHERE movie_id = $movie_id";
            $result = mysqli_query($conn, $sql);
            
            header("Location: dashboardmovies.php");
        ?>
    </body>
</html>
