<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/create.css">
    <title>Movie Create Complete</title>
</head>
<body>
    <?php
        $title = $_POST['title'];
        $description = $_POST['description'];
        $release_date = $_POST['release_date'];
        $formattedDate = date("Y-m-d", strtotime($release_date));
        $director = $_POST['director'];
        $rating = $_POST['rating'];
        $genre = $_POST['genre'];
        $teaser = $_POST['teaser_url'];
        $type = $_POST['type'];
        $running_time = $_POST['running_time'];
        $pictureName = @$_FILES['picture']['name'];
        $pictureType = @$_FILES['picture']['type'];
        $pictureSize = @$_FILES['picture']['size'];
        $pictureTmpName = @$_FILES['picture']['tmp_name'];
        $picture = "";
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbName = "streaming";

        $conn = mysqli_connect($hostname,$username,$password);
        if(!$conn){
            die("ไม่สามารถติดต่อกับ MySQL ได้");
        }
        mysqli_select_db($conn, $dbName) or die("ไม่สามารถเลือกฐานข้อมูล streaming ได้");
        mysqli_query($conn,"set character_set_connection=utf8mb4");
        mysqli_query($conn,"set character_set_client=utf8mb4");
        mysqli_query($conn,"set character_set_results=utf8mb4");
        if($_FILES['picture']['name'] == ""){
            echo '<br>คุณไม่ได้เลือกรูปภาพ';
        }
        else{
            move_uploaded_file($_FILES["picture"]["tmp_name"],"image/".$_FILES["picture"]["name"]);
            $picture = $_FILES["picture"]["name"];
        }
        $sql = "insert into movies(title,description,teaser,release_date,director,rating,type,genre,running_time,picture) values ('$title','$description','$teaser','$formattedDate','$director','$rating','$type','$genre','$running_time','$picture')";
        mysqli_query($conn, $sql) or die("เพิ่มหนังไม่สำเร็จ");
        mysqli_close($conn);
       ?>
       <?php
          session_start();
          $checkLogin = 1;
          if (!isset($_SESSION['Username'])){
            $checkLogin = 0;
          }
    ?>
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
            <a href="typemovie.php">Movies</a>
            <a href="typeseries.php">Series</a>
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
    <div class="mainbox">
    <h1>Add Movie Successful</h1>
        <form method="post" action="create2" enctype="multipart/form-data">
            <div class="info">
                <div class="left">
                    <?php 
                        echo "<p>$title </p>";
                        echo "<br><br>";
                        echo "<p>$director </p>";
                        echo "<br><br>";
                        echo "<p>$description </p>";
                        echo "<br><br>";
                        echo "<p>$teaser </p>";
                        echo "<br><br>";
                        echo "<img src ='image/$picture' class='infoimage'>";
                        echo "<br><br>";
                    ?>
                </div>
                <div class="right">
                    <?php 
                        echo "<p>$release_date </p>";
                        echo "<br><br>";
                        echo "<p>$rating </p>";
                        echo "<br><br>";
                        echo "<p>$genre </p>";
                        echo "<br><br>";
                        echo "<p>$running_time </p>";
                        echo "<br><br>";
                        echo "<p>ประเภท : $type </p>";
                        echo "<br><br>";  
                        echo "<p>กำลัง Redirect กลับหน้า Add Movie </p>";
                        echo "<script>setTimeout(function() { window.location.href='create.php'; }, 5000);</script>";
                    ?>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>