<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/movie.css">
    <title>Movie</title>
</head>
<body>
<header>
        <div class="headerbox1">
            <img src="image/Logo_JS_B_shade_white.png">
            <a href="index.php">Home</a>
            <a href="typemovie.php">Movies</a>
            <a href="typeseries.php">Series</a>
            <a href="">Favorite</a>
        </div>
      <div class="headerbox2"> 
        <a class="signup" href="login.php">Sign In</a>
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

                $embedUrl = getYoutubeEmbedUrl($row['teaser']);
                    echo "<iframe width='750' height='400'src='$embedUrl' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen>";
                    echo "</iframe>"
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
    <hr>
    <h1>Comment Section</h1>
    <div class="boxreview">
      <!-- <% if (moviedata.userName != "" ) { %> -->
        <label for="">Score</label>  
      <form method="post" action="/movie/<%=movie.movie_id%>" class="formment">
        <input type="number" name="score" id="myinput" min="0" max="5"  placeholder="0" >
        <div>
          <textarea required name="comment" id="commenting" cols="30" rows="5" placeholder="Comment Here"  oninvalid="this.setCustomValidity('Please Comment First')"
          oninput="this.setCustomValidity('')"></textarea>
          <input type="submit" value="Comment">
        </div>
       </form>
       <!-- <% } else { %> -->
        <p style="color: #faf0e6; font-size: 30px;">Please login before comment</p>
       <!-- <% } %> -->
    </div>
    <!-- <div class="boxread">

        <div class="eachcom">

            <div class="profcom">
              <img src="/images/<%= userData[j].profilePicture %> " alt="">
            </div>
            <div class="comsect">
             
              <div class="usersect">
                <p style="font-weight: 500;"> </p>
                <p style="margin-top: 1px; margin-left: 5px;"> <br></p>
              </div>

              <p class="usercomment">
             <br>
                <a href="/deletereview/<%=reviewData[i].review_id%>" onclick="return confirm('Do you confirm?')">Remove</a>

              </p>
            </div>


        </div>

    </div> -->
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