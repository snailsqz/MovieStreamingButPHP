<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbName = "streaming";
    $conn = mysqli_connect($hostname, $username, $password);
    if (!$conn)
        die("ไม่สามารถติดต่อกับ mySQL ได้");
    mysqli_select_db($conn, $dbName) or die("ไม่สามารถเลือกฐานข้อมูล books ได้");
    mysqli_query($conn, "set character_set_connection=utf8mb4");
    mysqli_query($conn, "set character_set_client=utf8mb4");
    mysqli_query($conn, "set character_set_results=utf8mb4");
    ?>
    <form enctype="multipart/form-data" name="save" method="post" action="movieInsert2.php">

    <br><br><table width="700" border="1" bgcolor="#ffffff">
    <tr>
        <th colspan="2" bgcolor="" height="21">Movie</th>
    </tr>
    <tr>
        <td width="200">Title : </td>
        <td><input type="text" name="title" size="50"maxlength="50"> </td>
    </tr>
    <tr>
        <td width="200">Description : </td>
        <td><input type="text" name="description" maxlength="25"size="20"></td>

    </tr>
    <tr>
        <td width="200">Release Date : </td>
        <td ><input type="date" name="release_date" maxlength="25"size="20"></td>
    </tr>
    <tr>
        <td width="200">Director : </td>
        <td><input type="text" name="director" size="20"maxlength="25"></td>
    </tr>
    <tr >
        <td width="200">Rating : </td>
        <td><input type="text" name="rating" maxlength="25"size="20"></td>
    </tr>
    <tr>
        <td width="200">Genre : </td>
        <td><input type="text" name="genre" maxlength="25"size="20"></td>
    </tr>
    <tr>
        <td width="200">Running Time : </td>
        <td><input type="text" name="running_time" maxlength="25"size="20"></td>
    </tr>
    <tr>
        <td width="200">Image : </td>
        <td><input type="file" name="picture" size="30"></td>
    </tr>
    </table>
        <br><input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    </form>
        <a href="index.php">กลับ home</a>
    </center>
</body>
</html>