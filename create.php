<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/create.css">
    <title>Movie Create</title>
</head>
<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbName = "streaming";

    $conn = mysqli_connect($hostname, $username, $password);
    if (!$conn)
        die("ไม่สามารถติดต่อกับ SQL ได้");
    mysqli_select_db($conn, $dbName) or die("ไม่สามารถเลือกฐานข้อมูล bookStore ได้");
    mysqli_query($conn, "set character_set_connection=utf8mb4");
    mysqli_query($conn, "set character_set_client=utf8mb4");
    mysqli_query($conn, "set character_set_results=utf8mb4");
?>

<body>
    <header>
        <div class="headerbox1">
            <img src="image/Logo_JS_B_shade_white.png">
            <a href="index.php">Home</a>
            <a href="typemovie.php">Movies</a>
            <a href="typeseries.php">Series</a>
            <a href="">Favorite</a>
        </div>
      <div class="headerbox2"> 
        <a class="signup" href="login.php">Sign In</a>
      </div>
    </header>
    <div class="mainbox">
    <h1>Add Movie</h1>
        <form method="post" action="create2.php" enctype="multipart/form-data">
            <div class="info">
                <div class="left">
                    <input type="text" name="title" placeholder="Title" />
                    <br><br>
                    <input type="text" name="director" placeholder="Director"/>
                    <br><br>
                    <textarea name="description" id="" cols="50" rows="30" placeholder="Description" style=" resize: none;"></textarea>
                    <br><br>
                    <input type="text" name="teaser_url" placeholder="Teaser URL"/>
                    <br><br>
                    <input style="color: #faf0e6;" type="file" name="picture" />
                    <br><br>
                </div>
                <div class="right">
                    <input type="text" name="release_date" placeholder="DD/MM/YYYY"/>
                    <br><br>
                    <input type="text" name="rating" placeholder="13+"/>
                    <br><br>
                    <input type="text" name="genre" placeholder="Romantic/Action"/>
                    <br><br>
                    <input type="text" name="running_time" placeholder="180"/>
                    <br><br>
                    <label for="">Type:
                    <select name="type">
                        <option name="type" value="Movie">Movie</option>
                        <option name="type" value="Series">Series</option>
                    </select>
                    <br><br>
                    <input type="submit" value="Add Movie" class="btn"/>
                    </label>
                </div>
            </div>
        </form>
    </div>
</body>
</html>