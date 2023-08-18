<?php
session_start();
require_once('DB/helpers.php');

$un = $pass = $username_error = $password_error = "";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music_webapp";

if (isset($_POST['done'])) {
    $un = empty($_POST['userName']) ? ($username_error = "User Name is required") : prepare($_POST['userName']);
    $pass = empty($_POST['pass']) ? ($password_error = "Password is required") : prepare($_POST['pass']);

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and bind the parameters to prevent SQL injection
    // Assuming you have retrieved the username and password from the user input
    $un = $_POST['userName'];
    $pass = $_POST['pass'];

    $sql = "SELECT username, `password` FROM users WHERE username = '$un' AND `password` = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['Un'] = $un;
        $_SESSION['notReg'] = "You already have an account";
        mysqli_close($conn);
        header('Location: index2.html');
        exit();
    } else {
        $_SESSION['notReg'] = "You don't have any accounts";
        header('Location: login.php');
        $_SESSION['username_error'] = $username_error;
        $_SESSION['password_error'] = $password_error;
        exit();
    }



} else {
    header('Location: login.php');
    exit();
} ?>