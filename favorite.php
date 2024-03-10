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
            <?php if($_SESSION['User_role'] == 'User') {?>
            <a href="typemovie.php">Movies</a>
            <a href="typeseries.php">Series</a>
            <a href="favorite.php">Favorite</a>
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

    <h1 class="welcome">Your Favorite List!</h1>
    <div class="mainbox">
        <?php

        
        ?>
      <!-- <% if (movies.length == 0) { %> -->
        <p class="favtxt">No favorite now! Let's add something</p>
      <!-- <% } %>
      
      <% for(let i = 0; i < movies.length; i++){%> -->
  
        <div class="imgitem">
          <!-- <a href="/movie/<%=movies[i].movie_id%>"><img src="/images/<%= movies[i].imageFile %>"></a>
          <a href="/movie/<%=movies[i].movie_id%>"><%= movies[i].title %></a> -->
        </div>
      <!-- <%}%> -->
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

      </table>
      <p>For Educational Purpose Only</p>
      
    </footer>
</body>
</html>