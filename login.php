<?php
session_start();
include("db.php");

if(isset($_SESSION["sessionid"]) && isset($_SESSION["sessionname"])){
    header("Location: index.php");
}


if(isset($_POST["login"])){
    $password = mysqli_real_escape_string($CON,$_POST["password"]);
    $username = mysqli_real_escape_string($CON,$_POST["username"]);
    $password = stripslashes($password);
    $username = stripslashes($username);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $username = filter_var($username, FILTER_SANITIZE_STRING);


    $query    = mysqli_query($CON,"SELECT * FROM user WHERE username = '$username'");
    $rows     = mysqli_fetch_assoc($query);
    $hsh_pass = $rows["password"];
    if(password_verify($password, $hsh_pass)){
            $_SESSION["sessionid"] = session_id();
            $_SESSION["sessionname"] = $username;
            header("Location: index.php");
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
<div class="login-form">
    <h3>l0g1n</h3>
    <form action="login.php" method="POST">
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
                <td><input type="submit" value="l0g1n" name="login"></td>
            </tr>
        </table>
    </form>
    <a href="index.php">back to index</a>
</div>
</body>
</html>
