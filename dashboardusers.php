<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Movie</title>
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
    <div class="mainbox">
      <table>
        <tr>
          <th></th><th style="text-align:center;">ID</th><th style="text-align:center;">Title</th><th style="text-align:center;">Director</th><th style="text-align:center;">Type</th><th colspan="2" style="text-align: center;">Action</th>
        </tr>
        <?php
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
          $sql = "select * from user order by user_id";
          $result = mysqli_query ($conn, $sql);
          while ($rs = mysqli_fetch_array($result))
          { ?>
          <tr>
            <td style="width: 100px;"><img src="image/<?php echo $rs[5]?>" alt="" class="profile"></td>
            <td style="text-align: center; "><?php echo $rs[0]?></td>
            <td style="width: 100px; text-align:center;"><?php echo $rs[1]?></td>
            <td style="width: 100px; text-align:center;"><?php echo $rs[6]?></td>
            <?php if($rs[6] == "Admin"){?>
                <td><a href="admin.php?user_id=<?php echo $rs[0]?>" class="promote" >Promote</a></td>
            <?php } else  {?>
                <td><a href="admin.php?user_id=<?php echo $rs[0]?>"  style="color:#6b6dee; width: 80px;">Promote</a></td>
            <?php } ?>
            <td style="text-align: center; width: 80px;"><a href="edituser.php?user_id=<?php echo $rs[0]?>" style="color:#3ff78b">Edit</a></td>
            <td style="text-align: center; width: 80px;"> <a href="deleteuser.php?user_id=<?php echo $rs[0]?>"
              onclick="return confirm('Do you confirm to delete this user?')" style="color:#f73f3f">Delete</a></td>
          </tr>
      <?php } ?>
    </table>
    </div>
      
</body>
</html>