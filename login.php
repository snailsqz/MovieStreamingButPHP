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
     if(isset($_GET['btnSubmit']))
     {
       session_start();
       $Username = $_GET['name'];
       $Password = $_GET['password'];
       $hostname = "localhost";
       $username = "root";
       $password = "";
       $dbname = "streaming";
       $conn = mysqli_connect( $hostname, $username, $password );
       if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
       mysqli_select_db ( $conn, $dbname )or die ( "ไม่สามารถเลือกฐานข้อมูล streaming ได้" );
       $sqltxt = "SELECT * FROM user where username = '$Username'";
       $result = mysqli_query ( $conn, $sqltxt );
       $rs = mysqli_fetch_array ( $result );
       if ( $rs ) {
          if ($rs['password'] == $Password) {
          $_SESSION['Username']=$Username;
          header("Location: index.php");
       }
       else {
          header("Location: login.php?error=1");
       }
       }
       else {
          header("Location: login.php?error=1");
       }
    }
    else {
   ?>

    <div class="mainbox">
      <div>
        <h1 class="login">Welcome</h1>
        <form method="get" action="#">
          <br>
          <?php
            if(isset($_GET['error']) == 1){
              echo "<p class='checklogin'>Wrong Username or Password</p>";
            }
          ?>
          <input type="text" name="name" placeholder="Username"/>
          <br><br>
          <input type="password" name="password" placeholder="Password" />
          <input type="submit" value="Login" class="btn" name="btnSubmit"/>
        </form>
        <p class="signup">Don't have an account?⠀<a href="register.php">Sign Up!</a></p>
      </div>
      <div>
        <h1>NetBoss</h1>
          <p style="text-indent: 20px;">NetBoss is the ultimate movie streaming platform that brings you the best selection of movies from around the world. With NetBoss, you can enjoy a wide range of genres, including action, romance, comedy, thriller, 
            and more. Our extensive library of movies ensures that there is always something for everyone.</p>
      </div>
    </div>
    <?php
    }
    ?>
  </body>
</html>
