<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/movie.css">
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
      $hostname = "localhost";
      $username = "root";
      $password = "";
      $dbName = "streaming";

      $conn = mysqli_connect($hostname, $username, $password);
      if (!$conn) {
          die("Failed to connect to the database");
      }
      mysqli_select_db($conn, $dbName) or die("Can't choose database");
      mysqli_query($conn,"set character_set_connection=utf8mb4");
      mysqli_query($conn,"set character_set_client=utf8mb4"); // TH Language
      mysqli_query($conn,"set character_set_results=utf8mb4");
      if(isset($_GET['movie_id'])) {   // checking if $_get is null or not and then get value book_id from URL
        $movieIdURL = $_GET['movie_id']; // name need 2bt same with Var that declare in PHP
        $sql = "SELECT * FROM movies WHERE movie_id = $movieIdURL"; // SQL Command needs to be UPPERCASE And BookID here need 2bt same with SQL column name
        $result = mysqli_query ($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
        } else {
          echo "ไม่พบข้อมูลของหนังเรื่องนี้";
        }
      } else {
        echo "ไม่มีค่าของ movie_id ที่รับมา";
      }
          
    ?>
    <div class="mainbox">
        <div class="box1">
            <div>
                <?php
                if(!empty($row['picture'])) {
                  echo "<img src='image/{$row['picture']}'>";
                } else {
                  echo "<img src='image/noimage.jpg'>";
                }
                ?>
            </div>
            <div>
                <?php 
                 function getYoutubeEmbedUrl($youtubeUrl) {
                  $matches = array();
                  if (preg_match("/\/watch\?v=([^\?]*)/", $youtubeUrl, $matches)) {
                    $videoId = $matches[1];
                    return "https://www.youtube.com/embed/" . $videoId;
                  } else {
                    // Handle invalid YouTube URL
                    return "Invalid YouTube URL";
                  }
                }
                if(!empty($row['teaser'])) {
                  $embedUrl = getYoutubeEmbedUrl($row['teaser']);
                  echo "<iframe width='750' height='400'src='$embedUrl' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen>";
                  echo "</iframe>";
                } else {
                  echo "Video Not Avalible yet";
                }
              ?>
            </div>
        </div>
        <div class="box2">
            <!-- <h2 class="fade-in-right "><i class="fa-regular fa-heart"></i>⠀ Add to your favorite!</h2> -->
            <?php
            $formattedDate = date("d-m-Y", strtotime($row['release_date']));

            echo "<h1>".$row['title']."</h1>";
            echo "<p style='text-indent: 30px ; text-align:justify; margin-bottom:30px;'' >".$row['description']."</p>";
            echo '<hr style="margin-bottom:30px;">';
            echo "<p>Director: ".$row['director']."</p>";
            echo "<p>Genre: ".$row['genre']."</p>";
            echo "<p>Release Date: ".$formattedDate."</p>";
            echo "<p>Type: ".$row['type']."</p>";
            echo "<p>Rating: ".$row['rating']."</p>";
            echo "<p>Running Time: ".$row['running_time']."</p>";
            ?>
        </div>
        <!-- <form method="post" action="/favorite">
          <input hidden type="text" name="movie_id" value="<%=movie.movie_id %>">
          <input hidden type="text" name="user_id" value="<%=moviedata.user_id %>">
          <% if (!favoriteStatus) { %>
            <button type="submit" class="btn">Favorite</button>
          <% } else { %>
            <button type="submit" class="btn2">Unfavorite</button>
          <% } %>
        </form> -->
    </div>
  </div>
  <div class="box3">
  <?php
        if(isset($_GET['btnComment']))
        {
          $userID = $_SESSION['User_id'];
          $movie_id = $_GET['movie_id'];
          $score = $_GET['score'];
          $comment = $_GET['comment'];

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

          $sql = "insert into reviews(movie_id, user_id , score, comment) values ('$movie_id','$userID','$score', '$comment')";
          mysqli_query($conn, $sql) or die("Error" .mysqli_error($conn));
          header("Location: movie.php?movie_id=$movie_id");
        }
    ?>
    <hr>
    <h1>Comment Section</h1>
    <div class="boxreview">
      <?php  if (isset($_SESSION['Username'])){ ?>
        <label for="">Score</label>  
      <form method="get" action="#" class="formment">
        <?php
        echo "<input type='hidden' name='movie_id' value='$movieIdURL'>";
        ?>
        <input type="number" name="score" id="myinput" min="0" max="5"  placeholder="0" >
        <div>
        <textarea required name="comment" id="commenting" cols="30" rows="5" placeholder="Comment Here"  oninvalid="this.setCustomValidity('Please Comment First')" oninput="this.setCustomValidity('')"></textarea>
        <input name="btnComment" type="submit" value="Comment">
        </div>
       </form>
       <?php } else { 
        echo "<p style='color: #faf0e6; font-size: 30px;'>Please login before comment</p>";
        } ?>
    </div>
    <div class="boxread">
      <?php
        $movie_id = $_GET['movie_id'];
        $commentsql = "SELECT movies.movie_id, user.user_id, user.username, user.image, reviews.review_id, reviews.score, reviews.comment
        FROM movies
        INNER JOIN reviews ON movies.movie_id = reviews.movie_id
        INNER JOIN user ON reviews.user_id = user.user_id
        WHERE reviews.movie_id = $movie_id;";
        $resultcomment = mysqli_query ($conn, $commentsql);
        while ($rs = mysqli_fetch_array($resultcomment))
        {
      ?>
        <div class="eachcom">
            <div class="profcom">
              <?php echo "<img src='image/".$rs[3]."' alt=''>" ?>
            </div>
            <div class="comsect">
             
              <div class="usersect">
                <p style="font-weight: 500;"><?php echo $rs[2] ?></p>
                <p style="margin-top: 1px; margin-left: 5px;"> <br></p>
              </div>

              <p class="usercomment">
              <?php 
              echo $rs[5]." / 5";
              echo " | ";
              echo $rs[6];
              if (!isset($_SESSION['Username'])){
                $checkLogin = 0;
              } else {
                if ($_SESSION['User_id'] == $rs[1]){
              ?>
                <br>
                <a href="<?php echo 'deletecomment.php?review_id='.$rs[4]?>"onclick="return confirm('Do you confirm to remove this comment')" style="color:#f73f3f">Remove</a>
                <?php } ?>
              </p>
            </div>
        </div>
        <?php 
          }
        }
        ?>
    </div>
  </div>
  <?php 
  mysqli_close($conn);
  ?>
  <script>
    document.getElementById('myinput').addEventListener('keydown', function(e) {
        e.preventDefault();
    });
  </script>
</body>
</html>