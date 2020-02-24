<?php
session_start();
include("db.php");
error_reporting(0);
ini_set('display_errors', 0);

$thread_id = $_GET["id"];

$query = mysqli_query($CON, "SELECT * FROM threads WHERE ID = '$thread_id'");
$row = mysqli_fetch_assoc($query);
$id = $row["ID"];
$owner = $row["owner"];
$owner = "<a href='/phpForum/user.php?name=$owner'>$owner</a>";
$title = $row["title"];
$date = $row["date"];
$content = $row["content"];
$content = strip_tags($content);
?>
<html lang="en">
<head>
    <title><?php echo "thread: ".$title;?></title>
    <link rel="stylesheet" href="css/showthread.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
<div class="nav">
    <div class="nav-content">
        <a href="index.php">back</a>
    </div>
</div>
<div class="content-wrapper">
    <div class="thread">
        <div class="thread-owner">
            <p>poster: <?php echo $owner; ?></p>
            <p>thread id: <?php echo $id; ?></p>
            <p>post date: <?php echo $date; ?></p>
        </div>
        <div class="thread-content">
            <p style="border-bottom: 1px solid lime"><?php echo $title; ?></p>
            <textarea spellcheck="false" disabled><?php echo $content; ?></textarea>
        </div>
    </div>
    <div class="comment-wrapper">

        <div class="comments">
            <h3>comments: <?php
                $query = mysqli_query($CON, "SELECT * FROM comments WHERE thread_id = '$thread_id'");
                $row = mysqli_fetch_assoc($query);
                $num = mysqli_num_rows($query);
                $num;
                echo $num;?></h3>
            <form action="showthread.php?id=<?php echo $thread_id;?>" method="post">
                <input type="text" name="comment_text" id="comment_text" autocomplete="off">
                <input type="submit" name="post_comment" id="post_comment" value="post">
            </form>
            <?php
            //post comment
            if(isset($_POST["post_comment"])){
                $comment = mysqli_real_escape_string($CON,$_POST["comment_text"]);
                $username = $_SESSION["sessionname"];
                if(empty($username)){
                    $username = $_SERVER["REMOTE_ADDR"];
                }
                $comment = stripslashes($comment);
                $comment = filter_var($comment, FILTER_SANITIZE_STRING);
                $comment = strip_tags($comment);
                $date = date("d.m.Y h:i");

                if(empty($comment)){
                    echo "bruh";
                    exit;
                }
                $query    = mysqli_query($CON, "INSERT INTO comments (thread_id, owner, date, content) VALUES ('$thread_id','$username','$date','$comment')");
                header("Location: showthread.php?id=$thread_id");
            }

            //show comments
            $query = mysqli_query($CON, "SELECT * FROM comments WHERE thread_id = '$thread_id'");
            $row = mysqli_fetch_assoc($query);
            $num = mysqli_num_rows($query);
            if($row==0){
                echo "<p>no comments yet</p>";
                exit;
            }
            echo "<table><tr><th>id</th><th>comment</th><th>date</th><th>poster</th></tr>";
            do{
                $comment_id = $row["ID"];
                $owner = $row["owner"];
                $owner = "<a href='/phpForum/user.php?name=$owner'>$owner</a>";
                $date = $row["date"];
                $content = $row["content"];

                echo "<tr><td>$comment_id</td><td width='70%'>$content</td><td>$date</td><td>$owner</td></tr>";
            }while($row = mysqli_fetch_assoc($query));
            echo "</table>";
            ?>
        </div>
    </div>
</div>
</body>
</html>
