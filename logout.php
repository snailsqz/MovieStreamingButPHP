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
        session_start();
        unset($_SESSION["User_role"]);
        unset($_SESSION["Username"]);
        unset($_SESSION["User_id"]);
        header("Location: index.php");
    ?>
  </body>
</html>
