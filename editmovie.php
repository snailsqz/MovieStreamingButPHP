<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/edituser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Movie</title>
</head>
<body>
<?php
    session_start();
    $checkLogin = 1;
    if (!isset($_SESSION['Username'])){
      $checkLogin = 0;
    }
    ?>
    <header>
        <div class="headerbox1">
            <img src="image/Logo_JS_B_shade_white.png">
            <a href="index.php">Home</a>
            <?php if($_SESSION['User_role'] == 'User') {?>
            <a href="typemovie.php">Movies</a>
            <a href="typeseries.php">Series</a>
            <a href="">Favorite</a>
            <?php }?>
            <?php if($_SESSION['User_role'] == 'Admin') {?>
            <a href="dashboardmovies.php">Movies</a>
            <a href="dashboardusers.php">Users</a>
            <?php }?>
        </div>
        <div class="headerbox2"> 
            <?php
              if($checkLogin == 0)
              echo '<a class="signup" href="login.php">Sign In</a>';
              else {
                ?> 
                <ul>
                  <li>
                    <?php?>
                    <img src="image/<?php echo $_SESSION['User_Image']?>" alt="" class="profile">
                    <ul class="dropdown">
                      <li><a href="edituser.php?user_id=<?php echo $_SESSION['User_id']; ?>">Edit User</a></li>
                      <li><a href="logout.php">Sign out</a></li>
                    </ul>
                  </li>
                </ul>
              <?php 
                  } 
              ?>
        </div>
    </header>
    <?php
    if (isset($_POST['btnSubmit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $release_date = $_POST['release_date'];
        $formattedDate = date("Y-m-d", strtotime($release_date));
        $director = $_POST['director'];
        $rating = $_POST['rating'];
        $genre = $_POST['genre'];
        $teaser = $_POST['teaser_url'];
        $type = $_POST['type'];
        $pictureName = @$_FILES['picture']['name'];
        $pictureType = @$_FILES['picture']['type'];
        $pictureSize = @$_FILES['picture']['size'];
        $pictureTmpName = @$_FILES['picture']['tmp_name'];
        $picture = "";

        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbName = "streaming";
        $userSessionId = $_SESSION['User_id'];
        $conn = mysqli_connect($hostname, $username, $password);
        if (!$conn)
            die("Fail to connect");
        mysqli_select_db($conn, $dbName) or die("Can't Choose db");
        mysqli_query($conn, "set character_set_connection=utf8mb4");
        mysqli_query($conn, "set character_set_client=utf8mb4");
        mysqli_query($conn, "set character_set_results=utf8mb4");

        if ($_FILES['picture']['name'] == "") {
            $sql = "UPDATE user SET username = '$Username', password = '$Password', name = '$Name', age = '$Age' WHERE user_id = $userSessionId";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "User information updated successfully.";
                header("Location: index.php");
            } else {
                echo "Failed to update user information.";
            }
        } else {
            move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
            $picture = $_FILES["picture"]["name"];
            $_SESSION['User_Image'] = $picture;
            $sql = "UPDATE user SET username = '$Username', password = '$Password', name = '$Name', age = '$Age', image = '$picture' WHERE user_id = $userSessionId";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "User information updated successfully.";
                header("Location: index.php");
            } else {
                echo "Failed to update user information.";
            }
        }
        mysqli_close($conn);
    }
    else{
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbName = "streaming";
        $conn = mysqli_connect($hostname, $username, $password);
        if(!$conn)
            die("Fail to connect");
        mysqli_select_db($conn, $dbName) or die("Can't Choose db");
        mysqli_query($conn,"set character_set_connection=utf8mb4");
        mysqli_query($conn,"set character_set_client=utf8mb4");
        mysqli_query($conn,"set character_set_results=utf8mb4");
        $userSessionId = $_SESSION['User_id'];
        $sql = "SELECT * FROM user WHERE user_id = $userSessionId";
        $result = mysqli_query ($conn, $sql);
        $counter = 0;
        while ($rs = mysqli_fetch_array($result)){
      ?>    
    <div class="mainbox">
    <h1>Update Movie</h1>
      <form method="post" action="#" enctype="multipart/form-data">
            <div class="info">
                <div class="left">
                    <input type="text" name="title" value="<?php echo $rs[1]?>"/>
                    <br><br>
                    <input type="text" name="director" value="<?php echo $rs[5]?>"/>
                    <br><br>
                    <textarea name="description" id="" cols="50" rows="30" style=" resize: none;" value="<?php echo $rs[2]?>"></textarea>
                    <br><br>
                    <input type="text" name="teaser_url" value="<?php echo $rs[3]?>"/>
                    <br><br>
                    <input style="color: #faf0e6;" type="file" name="picture" value="<?php echo $rs[10]?>"/>
                    <br><br>
                </div>
                <div class="right">
                    <input type="text" name="release_date" value="<?php echo $rs[4]?>"/>
                    <br><br>
                    <input type="text" name="rating" value="<?php echo $rs[6]?>"/>
                    <br><br>
                    <input type="text" name="genre" value="<?php echo $rs[8]?>"/>
                    <br><br>
                    <input type="text" name="running_time" value="<?php echo $rs[9]?>"/>
                    <br><br>
                    <label for="">Type:
                    <select name="type" value="<?php echo $rs[7]?>">
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
    <?php
        }
    }
    ?>
</body>
</html>