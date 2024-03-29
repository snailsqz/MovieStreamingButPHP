<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
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
            <?php if(!isset($_SESSION['User_role'])) {?>
              <a href="typemovie.php">Movies</a>
              <a href="typeseries.php">Series</a>
            <?php }?>
            <?php if(isset($_SESSION['User_role']) && $_SESSION['User_role'] == 'User') {?>
            <a href="typemovie.php">Movies</a>
            <a href="typeseries.php">Series</a>
            <a href="favorite.php">Favorite</a>
            <?php }?>
            <?php if(isset($_SESSION['User_role']) && $_SESSION['User_role'] == 'Admin') {?>
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
      if(isset($_SESSION['Username']))
        echo '<h2 class="fade-in-right"><i class="fa-solid fa-hands-clapping"></i> Welcome, ' . $_SESSION['Username'] . '!</h2>';
      else
        echo '<h2 class="fade-in-right" style="width: 170px;"><i class="fa-solid fa-hands-clapping"></i> Welcome !</h2>';
    ?>
    <div class="mainbox">
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
          $sql = "select * from movies order by movie_id";
          $result = mysqli_query ($conn, $sql);
          $num_rows = mysqli_num_rows($result);
          $counter = 0;
          if ($num_rows > 0) {
            while ($rs = mysqli_fetch_array($result))
            {
              if($counter == 0){
                echo "<div>";
                echo "<a href='movie.php?movie_id=".$rs[0]."' class='moviedes'";
                echo "<p>".$rs[1]."</p>";
                echo "<p>".$rs[2]."</p>";
                echo "</a>";
                echo "<a href='movie.php?movie_id=".$rs[0]."'><img src ='image/$rs[10]' class='bigimg'></a>";
                echo "</div>";
                $counter++; 
              }
              else{
                echo "<div class='imgitem'>";
                echo "<a href='movie.php?movie_id=".$rs[0]."'><img src ='image/$rs[10]'></a>";
                echo "<a href='movie.php?movie_id=".$rs[0]."'>".$rs[1]."</a>";
                echo "</div>";
              }
            }
        }else {
          echo "<a href='create.php' style='text-decoration: none; color: #faf0e6;  font-size: 24px;
          '>Let's start adding some movies</a>";
          }
          mysqli_close ( $conn );
      ?>    
    </div>
    <footer style="margin: 300px 0 0 0;">
      <p>NetBoss &copy; 2024 KMUTNB Project</p>
      <table>
        <tr>
          <th>Developers</th>
          <th>GitHub</th>
        </tr>
        <tr>
          <td>Pawee Indulakshana</td>
          <td><a href="https://github.com/snailsqz"><i class="fa-brands fa-github" style="font-size: 20px; color:aliceblue;"></i></a></td>
        </tr>
        <tr>
          <td>Jiramet Sakulkittavorn</td>
          <td><a href="https://github.com/Sencoool"><i class="fa-brands fa-github" style="font-size: 20px; color:aliceblue;"></i></a></td>
        </tr>
        <tr>
          <td>Nuttawat Amorntanont</td>
          <td><a href="https://github.com/Nuttawat28"><i class="fa-brands fa-github" style="font-size: 20px; color:aliceblue;"></i></a></td>
        </tr>
        <tr>
          <td>Thwainee Aruk </td>
          <td><a href="https://github.com/Nuttawat28"><i class="fa-brands fa-github" style="font-size: 20px; color:aliceblue;"></i></a></td>
        </tr>
        <tr>
          <td>Ampuchinee Yodtaisong </td>
          <td><a href="https://github.com/Nuttawat28"><i class="fa-brands fa-github" style="font-size: 20px; color:aliceblue;"></i></a></td>
        </tr>

      </table>
      <p>For Educational Purpose Only</p>
      
    </footer>
</body>
</html>