<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
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
                    <img src="image/noimage.jpg" alt="" class="profile">
                    <ul class="dropdown">
                      <li><a href="#">Edit User</a></li>
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

          $sql = "SELECT * FROM movies WHERE type = 'Movie' ORDER BY movie_id";
          $result = mysqli_query ($conn, $sql);
          $num_rows = mysqli_num_rows($result); // checking if movie exists
          mysqli_data_seek($result, 1); // result start at column 2
          $firstmovie = "SELECT * FROM movies WHERE type = 'Movie' ORDER BY movie_id LIMIT 1";
          $firstmovieresult = mysqli_query ($conn, $firstmovie);
          if ($num_rows > 0) {
            while ($rs = mysqli_fetch_array($result))
          {
            while ($firstrs = mysqli_fetch_array($firstmovieresult)){
              echo "<div>";
              echo "<a href='movie.php?movie_id=".$firstrs[0]."' class='moviedes'";
              echo "<p>".$firstrs[1]."</p>";
              echo "</a>";
              echo "<a href='movie.php?movie_id=".$firstrs[0]."'><img src ='image/$firstrs[10]'class='bigimg'></a>";
              echo "</div>";
              break;
            }
            echo "<div class='imgitem'>";
            echo "<a href='movie.php?movie_id=".$rs[0]."'><img src ='image/$rs[10]'></a>";
            echo "<a href='movie.php?movie_id=".$rs[0]."'>".$rs[1]."</a>";
            echo "</div>";
          }
          } else {
            echo "<a style='text-decoration: none;' href='create.php'><h1>Lets start add some movie</h1></a>";
          }
          mysqli_close ( $conn );
      ?>    
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    
    <footer>
      <p>NetBoss &copy; 2024 KMUTNB Project</p>
      <p>Pawee Indulakshana IT</p>
      <p>Jiramet Sakulkitthavorn IT</p>
      <p>Nuttawat Amorntanont IT</p>
      <p>For Educational Purpose Only</p>
</body>
</html>