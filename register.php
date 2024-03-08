<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/register.css">
    <title>Register</title>
    <style>
        .password{
           -webkit-text-security:disc;
       }
    </style>
  </head>
  <body>
    <?php
        if(isset($_GET['btnSubmit']))
        {
            session_start();
            $Username = $_GET['username'];
            $Password = $_GET['password'];
            $Name = $_GET['name'];
            $Age = $_GET['age'];
            $Gender = $_GET['gender'];
            $check = 0;
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $dbname = "streaming";
            $conn = mysqli_connect( $hostname, $username, $password );
            if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้");
            mysqli_select_db ( $conn, $dbname )or die ( "ไม่สามารถเลือกฐานข้อมูล streaming ได้" );
            mysqli_query($conn,"set character_set_connection=utf8mb4");
            mysqli_query($conn,"set character_set_client=utf8mb4");
            mysqli_query($conn,"set character_set_results=utf8mb4");

            $sqltxt = "SELECT * FROM user where username = '$Username'";
            $result = mysqli_query ( $conn, $sqltxt );
            while($rs = mysqli_fetch_assoc($result)){
                if($rs['username'] == $Username){
                    $check = 1; 
                }
            }
            if($check == 0){
                $sql = "insert into user(username, password, name, age, gender) values 
                ('$Username', '$Password', '$Name', '$Age', '$Gender')";
                mysqli_query($conn, $sql) or die("insert ลงตาราง book มีข้อผิดพลาดเกิดขึ้น" .mysqli_error());
                header("Location: login.php");
            }
            else{
                header("Location: register.php?error=1");
            }
        }
        else{
    ?>
    <div class="mainbox">
        <div>
            <h1 class="login">Register</h1>
            <form method="get" action="#">
              <br>
                <?php
                if(isset($_GET['error'])){
                  echo "<p style='color:red;'>Username already exists</p>";
                }
                ?>
              <input type="text" name="username" minlength="3"  maxlength="10" placeholder="Username" required/>
              <br><br>
              <input type="text" name="name" minlength="1"  maxlength="10" placeholder="Name" required/>
              <br><br>
              <input type="text" name="age" minlength="1"  maxlength="10" placeholder="Age" required/>
              <br><br>
              <input type="text" name="gender" minlength="1"  maxlength="10" placeholder="Gender" required/>
              <br><br>
              <input class="password" type="text" name="password" minlength="1" placeholder="Password" required/>
              <input name="btnSubmit" type="submit" value="Submit" class="btn">
            </form>
            <p class="signin">Already have an account?⠀<a href="/login">Sign In!</a></p>
        </div>
    </div>
    <?php
        }
    ?>
  </body>
</html>
