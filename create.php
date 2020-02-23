<?php
session_start();
include("db.php");
if(!isset($_SESSION["sessionid"])&&!isset($_SESSION["sessionname"])){
    header("Location: index.php");
}

//User info
$username = $_SESSION["sessionname"];
// creating thread

if(isset($_POST["create"])){
    $content = mysqli_real_escape_string($CON,$_POST["content"]);
    $content = strip_tags($content);
    $content = filter_var($content, FILTER_SANITIZE_STRING);
    $content = stripslashes($content);

    $title = mysqli_real_escape_string($CON,$_POST["title"]);
    $title = strip_tags($title);
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $title = stripslashes($title);

    $date = date("d.m.Y h:i");
    if(empty($content)||empty($title)){
        echo "cannot be empty.";
    }else{
        $query = mysqli_query($CON, "INSERT INTO threads (owner, date, content, title) VALUES ('$username','$date','$content','$title')");
        header("Location: index.php");
    }
}
?>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/create.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
<div class="create-thread-wrapper">
    <form action="create.php" method="post">
        <label>title: <br><input type="text" name="title" id="title"></label><br>
        <br>
        <label>thread:<br><textarea autocomplete="off" type="text" name="content" id="content"></textarea></label>
        <br><br>
        <input type="submit" name="create" id="create">
        <?php echo "posting as: $username"; ?>
    </form>
</div>
</body>
</html>