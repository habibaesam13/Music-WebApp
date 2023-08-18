<?php
//to show  songs on each playlist
session_start();
if (isset($_GET['playListId'])) {
    $PLI = $_GET['playListId'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "music_webapp";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT song.Sname,song.addedAt,playlists.playlistname from song,playlists where song.playlistId='$PLI'&&playlists.id='$PLI' ";
    $result = $conn->query($sql);


} else {
    echo '<li class="list-group-item">PlayList Id not provided</li>';
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show PlayList Songs</title>
    <style>
        body {
            background-color: rgb(25, 24, 24);
        }

        .forForm {
            background-color: rgb(52, 50, 50);
            margin-left: 30%;
            margin-top: 10%;
            width: 700px;
            height: 350px;
            border-radius: 20px;

        }

        .forForm:hover {
            box-shadow: 20px 10px 5px white;
            transform: translate(10px, -15px);
        }

        input {
            background-color: rgb(232, 227, 227);
            text-align: center;
            border-radius: 15px;
            width: 250px;
            height: 30px;
            border-color: green;
        }

        .in {
            padding-top: 60px;
            padding-left: 30%;
        }

        .in2 {

            padding-top: 50px;
            padding-left: 30%;
        }

        #sub {
            border-color: green;
            height: 40px;
            font-weight: bold;
        }

        @font-face {
            font-family: 'logo';
            src: url(assets/font/GvtimeRegular-AL6Jg.otf);
        }

        #nameApp::first-letter {
            color: green;
            font-family: logo;
        }


        .logo {
            padding-top: 20px;
            color: rgb(255, 255, 255);
            font-size: 25px;
            padding-left: 40%;
            font-family: logo;
            letter-spacing: .2em;
            width: fit-content;
            height: fit-content;
        }

        .containor {
            background-color: rgb(52, 50, 50);
            color: white;
            margin-left: 35%;
            margin-top: 2%;
            width: 550px;
            height: 200px;
            border-radius: 15px;
            font-size: 15px;
        }

        .data {
            margin-left: 30%;
            padding-top: 7%;
        }

        .btn {
            background-color: green;
            width: 150px;
            height: 30px;
            margin-left: 20px;
        }

        .btn:hover {
            background-color: blue;
        }

        a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .goback {
            margin-left: 47%;
        }
    </style>
</head>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="containor">
            <div class="data">PlayList Name:
                <?php echo $row["playlistname"] ?>
                <p> song name:
                    <?php echo $row["Sname"] ?>
                </p>
                <p>Added At:
                    <?php echo $row["addedAt"] ?>
                </p>
            </div>
        </div>
    <?php }
    // Close the loop here

    // Place the "Go back" button after the loop
    echo '<button type="submit" class="btn goback"><a href="add.php">Go back</a></button>';
} else {
    echo '<div style="color:white; font-weight: bold; margin-left:45%;margin-top:7%;font-size:20px;">Add New songs Now!!</div>';
}
$conn->close();
?>


<!-- ask to add songs -->

<!-- add playlist -->
<div class="forForm">
    <form action="<?php $_PHP_SELF ?>" method="post">
        <div class="in"><input name="songName" placeholder="Song Name" style="text-align:center"></div>
        <div class="in2"> <input type="submit" value="Create" name="create" id="sub"></div>
    </form>
    <div class="logo" id="nameApp">TuneHub</div>
</div>


</body>

</html>


<?php
require_once("DB/helpers.php");
if (isset($_POST['create'])) {
    if (isset($_GET['playListId'])) {
        if (!empty($_POST['songName'])) {
            $PLI = $_GET['playListId'];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "music_webapp";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $songName = prepare($_POST['songName']);
            $sql = "INSERT INTO song (Sname, playlistId,addedAt) VALUES ('$songName','$PLI',NOW())";
            if ($conn->query($sql) === TRUE) {
                $msg = '<p style="margin-left:47%;color:green;">New Song Added successfully<p>';
                echo $msg;
                unset($msg);

            } else {
                echo '<p style="margin-left:45%;color:red">Error:This song is Added Before Check other playkists!! </p>';
                ;
            }
        } else {
            echo '<p style="margin-left:45%;color:red">Error:Song Name Is Required </p>';
        }
    } else {
        $errMsg = "Error:Can't get playlist id!!";
        echo '<div style="margin-left:40%;color:red"><b>' . $errMsg . '<b><div> ';
        unset($errMsg);

    }
}


?>