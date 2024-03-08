<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_date = $_POST['release_date'];
    $director = $_POST['director'];
    $rating = $_POST['rating'];
    $genre = $_POST['genre'];
    $running_time = $_POST['running_time'];
    $pictureName = @$_FILES['picture']['name'];
    $pictureType = @$_FILES['picture']['type'];
    $pictureSize = @$_FILES['picture']['size'];
    $pictureTmpName = @$_FILES['picture']['tmp_name'];
    $picture = "";
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbName = "streaming";
    $conn = mysqli_connect($hostname, $username, $password);
    echo '<center>';
    if (!$conn)
        die("ไม่สามารถติดต่อกับ mySQL ได้");
    mysqli_select_db($conn, $dbName) or die("ไม่สามารถเลือกฐานข้อมูล books ได้");
    mysqli_query($conn,"set character_set_connection=utf8mb4");
    mysqli_query($conn,"set character_set_client=utf8mb4");
    mysqli_query($conn,"set character_set_results=utf8mb4");
    if ($_FILES['picture']['name']=="") {
        echo '<b><li>คุณไม่ได้เลือกรูปภาพ</li></b><br>';
    }
    else
    {
        move_uploaded_file($_FILES["picture"]["tmp_name"],"images/".$_FILES["picture"]["name"]);
        $picture = $_FILES['picture']['name'];
    }
    $sql = "insert into movies(title, description, release_date, director, rating, genre, running_time,
    picture) values ('$title', '$description', '$release_date', '$director', '$rating', '$genre', '$running_time', '$picture')";
    mysqli_query($conn, $sql) or die("insert ลงตาราง book มีข้อผิดพลาดเกิดขึ้น" .mysqli_error());
    echo '<br><br><h2>บันทึกข้อมูลหนังสือรหัส '.$title.' เรียบร้อย</h2>';
    echo '<br><br><a href="index.php">กลับหน้า index.php</a>';
    mysqli_close($conn);
    echo '</center>';
?>
</body>
</html>