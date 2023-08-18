<?php
session_start();

//connect to database to insert
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music_webapp";
$un = $_SESSION['Un'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `id` from `users` where `username`='$un' ";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    while ($row = $result->fetch_assoc()) {
        $Uid = $row['id'];
        $_SESSION['uid'] = $Uid;
    }
    $sql = "SELECT playlistname,created_at,id from playlists where User_id='$Uid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>


        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>playLists</title>
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
                    height: 150px;
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
            </style>
        </head>

        <body>
            <!-- show current play lists -->
            <div style="margin-left:45%; margin-top:50px;">
                <p style="color:white;font-weight: bold;  text-shadow: 1px 1px green;font-size:20px;">
                    <?php echo $_SESSION['Un']; ?> Play Lists:
                </p>
            </div>

            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="containor">
                    <div class="data">PlayList Name:
                        <?php echo $row['playlistname']; ?>
                        <p> Created At:
                            <?php echo $row['created_at']; ?>
                        </p>
                        <div>
                            <?php echo '<button type="button" class="btn" name="show"><a href="show.php?playListId=' . $row['id'] . '">Show</a></button>' ?>
                        </div>
                    </div>
                </div>
            <?php }
    } else { ?>
            <div style="color:white; font-weight: bold; margin-left:35%">You don't create any lists before!</div>

        <?php }
} ?>


    <?php

    function sendPLError()
    {
        if (isset($_SESSION['nameError'])) {
            echo $_SESSION['nameError'];
            unset($_SESSION['nameError']);
        }
    }

    ?>

    <!-- ask to add playList -->

    <!-- add playlist -->
    <div class="forForm">
        <form action="handelAdd.php" method="post">
            <div class="in"><input name="playListName" placeholder="playList Name" style="text-align:center"><span
                    style="color:red">*
                    <?php sendPLError(); ?>
                </span></div>
            <div class="in2"> <input type="submit" value="Create" name="create" id="sub"></div>
        </form>
        <div class="logo" id="nameApp">TuneHub</div>
    </div>


</body>

</html>