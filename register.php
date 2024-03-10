<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/register.css">
    <title>Register</title>
    <style>
        .password{
           -webkit-text-security:disc;
       }
       input[type="number"] {
          height: 32px;
          border-radius: 4px;
          border: 1px solid #d8d8d8;
          position: relative;
          text-align: center;
          font-size: 20px;
          width: 140px;
          outline: none;
          background-image: url("data:image/svg+xml;utf8,%3Csvg%20version%3D%221.1%22%20viewBox%3D%220%200%2050%2067%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22none%22%20stroke-width%3D%222%22%3E%3Cline%20x1%3D%221%22%20x2%3D%2250%22%20y1%3D%2233.5%22%20y2%3D%2233.5%22%20stroke%3D%22%23D8D8D8%22%2F%3E%3Cpolyline%20transform%3D%22translate(25%2020)%20rotate(45)%20translate(-25%20-20)%22%20points%3D%2219%2026%2019%2014%2032%2014%22%20stroke%3D%22%23000%22%2F%3E%3Cpolyline%20transform%3D%22translate(25%2045)%20rotate(225)%20translate(-25%20-45)%22%20points%3D%2219%2052%2019%2039%2032%2039%22%20stroke%3D%22%23000%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E");
          background-position: center right;
          background-size: contain;
          background-repeat: no-repeat;
          caret-color: transparent;
        }

        input[type="number"]::-webkit-inner-spin-button {
          -webkit-appearance: none !important;
          opacity: 1 !important;
          background: transparent !important;
          border-width: 0px;
          margin: 0;
          border-left: 1px solid #d8d8d8;
          height: 34px;
          width: 23px;
          cursor: pointer;
        }
        .center-input {
          display: block;
          margin-left: auto;
          margin-right: auto;
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
                $sql = "insert into user(username, password, name, age) values 
                ('$Username', '$Password', '$Name', '$Age')";
                mysqli_query($conn, $sql) or die("Error" .mysqli_error($conn));
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
                  echo "<p class='checklogin'>Username already exists</p>";
                }
                ?>
              <input class="center-input" type="text" name="username" minlength="3"  maxlength="10" placeholder="Username" required/>
              <br>
              <input class="center-input" type="text" name="name" minlength="1"  maxlength="30" placeholder="Name" required/>
              <br>
              <input class="center-input" type="number" name="age" min="0" max="100"  placeholder="Age" >
              <br>
              <input class="password" type="text" name="password" minlength="1" placeholder="Password" required/>
              <input name="btnSubmit" type="submit" value="Submit" class="btn">
            </form>
            <p class="signin">Already have an account?⠀<a href="login.php">Sign In!</a></p>
        </div>
    </div>
    <?php
        }
    ?>
  </body>
</html>
