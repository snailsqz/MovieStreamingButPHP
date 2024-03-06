<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="headerbox1">
            <img src="pictures/Logo_JS_B_shade_white.png">
            <a href="index.php">Home</a>
            <a href="/typemovie">Movies</a>
            <a href="/typeseries">Series</a>
            <a href="/favorite>">Favorite</a>
        </div>
      <div class="headerbox2"> 
        <a class="signup" href="/login">Sign In</a>
      </div>
    </header>
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
        $row=1;
        while ($rs = mysqli_fetch_array($result))
        {
            echo '<a href="bookDetail1.php?bookId='.$rs[0].'">'.'ID'.'</a>';
            echo $rs[1];
            echo '<a href="bookUpdate1.php?bookId='.$rs[0].'">[แก้ไข]</a>';
            echo '<a href="bookDelete1.php?bookId='.$rs[0].'"onclick="return confirm(\' ยืนยันการลบข้อมูลหนังสือ '.$rs[1].'\')">[ลบ]</a>';
            $row++;
        }
        
        mysqli_close ( $conn );
        echo '<br><br><a href="menu1.php">Back to menu</a>';
        echo '</center>';
    ?>    
    <div class="mainbox">
      <div>
        <a href="/movie>" class="moviedes">
          <p><%= movies[0].title %></p>
          <p><%= movies[0].desc%></p>
        </a> 
        <a href="/movie>"><img src="pictures/<%= movies[0].imageFile %>" class="bigimg"></a>
      </div>

      <% for(var i = 1; i < movies.length; i++){%>
        <div class="imgitem">
          <a href="/movie/<%=movies[i].movie_id%>"><img src="pictures/<%= movies[i].imageFile %>"></a>
          <a href="/movie/<%=movies[i].movie_id%>"><%= movies[i].title %></a>
        </div>
      <%}%>
    </div>
</body>
</html>