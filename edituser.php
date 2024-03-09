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
            <a href="">Movies</a>
            <a href="">Series</a>
            <?php
              if($checkLogin == 1)
              echo '<a href="">Favorite</a>';
            ?>
        </div>
        <div class="headerbox2"> 
            <?php
              if($checkLogin == 0)
              echo '<a class="signup" href="login.php">Sign In</a>';
              else {
                ?> 
                <ul>
                  <li>
                    <img src="image/noimage.jpg" alt="" class="profile">
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
        $Username = $_POST['username'];
        $Password = $_POST['password'];
        $Name = $_POST['name'];
        $Age = $_POST['age'];
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
      <h1>Update User</h1>
      <form action="#" method="post" enctype="multipart/form-data">
        <label for="">Username</label>
        <input type="text" name="username" value="<?php echo $rs[1]?>" placeholder=""/>
        <br><br>
        <label for="">Password</label>
        <input type="text" name="password" value="<?php echo $rs[2]?>"/>
        <br><br>
        <label for="">Name</label>
        <input type="text" name="name" value="<?php echo $rs[3]?>"/>
        <br><br>
        <label for="">Age</label>
        <input type="text" name="age" value="<?php echo $rs[4]?>"/>
        <br><br>
        <label for="">Profile Picture</label>
        <input type="file" name="picture"/>
        <a href="/deleteuser>"onclick="return confirm('You delete really')">Delete User</a>
        <input name="btnSubmit" type="submit" value="Submit" class="btn" />
      </form>
    </div>
    <?php
        }
    }
    ?>
</body>
</html>