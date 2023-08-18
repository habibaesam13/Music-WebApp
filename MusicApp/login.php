<?php
session_start();
function sendUNErro()
{
    if (isset($_SESSION['username_error'])) {
        echo $_SESSION['username_error'] . "<br>";
        unset($_SESSION['username_error']);
    }
}
function sendPassErro()
{
    if (isset($_SESSION['password_error'])) {
        echo $_SESSION['password_error'] . "<br>";
        unset($_SESSION['password_error']);
    }
}

function sendUnloginError()
{
    if (isset($_SESSION['notReg'])) {
        echo $_SESSION['notReg'] . "<br>";
        unset($_SESSION['notReg']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styleLogin.css" rel="stylesheet">
    <title>TuneHub-Login</title>
</head>

<body style=" background-color: rgb(25, 24, 24);">
    <div class="containor">
        <form method="post" action="handelLogin.php">

            <div class="in"> <input type="text" placeholder="USERNAME" name="userName"><span style="color:red">*
                    <?php sendUNErro(); ?>
                </span>
            </div>
            <div class="in">
                <input type="password" placeholder="PASSWORD" name="pass">
                <span style="color:red">*
                    <?php sendPassErro(); ?>
                </span>
            </div>
            <div class="in2"> <input type="submit" value="Login" name="done" id="sub"></div>
        </form>
        <span style="color:red;margin-left:35%;margin-top:5px">*
            <?php sendUnloginError(); ?>
        </span><b>
            <div id="forget" style="margin-left:-50px;">
                <a href="#" name="forget">Forrget password?</a>
            </div>
            <div id="forget" style="margin-left:15%;margin-top:-5%">
                <a href="index.html">Back</a>
            </div>
            <div class="logo" id="nameApp">TuneHub</div>
    </div>
</body>

</html>