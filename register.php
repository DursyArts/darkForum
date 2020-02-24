<?php
session_start();
include("db.php");

if(isset($_SESSION["sessionid"]) && isset($_SESSION["sessionname"])){
    header("Location: index.php");
}


if(isset($_POST["register"])){

    $password = mysqli_real_escape_string($CON,$_POST["password"]);
    $username = mysqli_real_escape_string($CON,$_POST["username"]);
    if(empty($password)){
        echo "Password cannot be empty";
    }else{
        if(empty($username)){
            echo "Username cannot be empty";
        }else{
            $password = stripslashes($password);
            $password = filter_var($password, FILTER_SANITIZE_STRING);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $username = stripslashes($username);
            $username = filter_var($username, FILTER_SANITIZE_STRING);
            $ip = $_SERVER["REMOTE_ADDR"];

            $query    = mysqli_query($CON,"SELECT * FROM user WHERE username = '$username'");
            $rows     = mysqli_num_rows($query);
            if($rows>=1){
                echo "User already registered.";
            }

            if($rows==0){
                $query    = mysqli_query($CON,"INSERT INTO user (username, password, ip) VALUES ('$username','$password', '$ip')");
                header("Location: index.php");
            }
        }
    }




}

?>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
<div class="register-form">
    <h3>r3g1st3r</h3>
    <form action="register.php" method="POST">
        <table>
            <tr>
                <td>username:</td>
                <td><input type="text" name="username" placeholder=" us3rn4m3" autocomplete="off"/></td>
            </tr>
            <tr>
                <td>password:</td>
                <td><input type="password" name="password" placeholder=" p4ssw0rd" autocomplete="off"/></td>
            </tr>
            <tr>
                <td><input type="submit" value="r3g1st3r" name="register"></td>
            </tr>
        </table>
    </form>
    <a href="index.php">back to index</a>
</div>
</body>
</html>