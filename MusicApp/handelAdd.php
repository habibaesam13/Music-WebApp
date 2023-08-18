<?php
session_start();
require_once('DB/helpers.php');
$PLN = "";
if (isset($_POST['create'])) {
    if (!empty($_POST['playListName'])) {
        $PLN = prepare($_POST['playListName']);

        //connect to database to insert
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "music_webapp";
        $Uid = $_SESSION['uid'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT Into playlists (`playlistname`,`User_id`) values ('$PLN','$Uid') ";

        if ($conn->query($sql) === TRUE) {
            header('location:add.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        mysqli_close($conn);
    } else {
        $_SESSION['nameError'] = "this field is required";
        header('location:add.php');
    }



} else {
    header('location:add.php');
}
?>