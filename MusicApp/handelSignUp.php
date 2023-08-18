<?php
session_start();
require_once('DB/helpers.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music_webapp";

$un = $pass = "";
if (isset($_POST['done'])) {


    if (!empty($_POST['userName']) && !empty($_POST['pass'])) {
        $un = prepare($_POST['userName']);
        $pass = prepare($_POST['pass']);


        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT `username`,`password` FROM users where `username`='$un' and `password`='$pass'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['notReg'] = "You already have an account";
            header('Location: signUp.php');
            exit();
        } else {
            if (empty($_POST['phone']) && empty($_POST['country'])) {
                $sql = "INSERT INTO users (username, `password`)
                VALUES ('$un','$pass')";
                if ($conn->query($sql) === TRUE) {
                    header('location:login.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else if (empty($_POST['phone']) && !empty($_POST['country'])) {
                $con = prepare($_POST['country']);
                $sql = "INSERT INTO users (username, `password`,country)
                VALUES ('$un','$pass','$con')";
                if ($conn->query($sql) === TRUE) {
                    header('location:login.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else if (empty($_POST['country']) && !empty($_POST['phone'])) {
                $phn = prepare($_POST['phone']);
                $sql = "INSERT INTO users (username, `password`,phone)
                VALUES ('$un','$pass','$phn')";
                if ($conn->query($sql) === TRUE) {
                    header('location:login.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                $phn = prepare($_POST['phone']);
                $con = prepare($_POST['country']);
                $sql = "INSERT INTO users (username, `password`, `phone`,`country`)
                  VALUES ('$un', '$pass', '$phn','$con')";

                if ($conn->query($sql) === TRUE) {
                    header('location:login.php');

                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();


    } else {


        $_SESSION['username_error'] = "User Name is required";
        $_SESSION['password_error'] = "Password is required";
        header('location:signUp.php');
    }


} else {
    header('location:signUp.php');
}











?>