<?php
session_start();
include("db.php");

if(isset($_GET["id"])||isset($_GET["name"])){

    if (isset($_GET["id"])) {
        $user_id = $_GET["id"];

        $query = mysqli_query($CON, "SELECT * FROM user WHERE ID = '$user_id'");
        $num = mysqli_num_rows($query);
        if ($num == 0) {
            echo "error: no user found with that id<br>";
            echo "<a href='user.php'>back to search</a>";
            exit;
        } else {
            echo "<table border=1><tr><th>ID</th><th>name</th><th>role</th><th>post count</th><th>thread count</th><th>profile picture</th></tr>";
            while ($row = mysqli_fetch_assoc($query)) {
                $username = $row["username"];
                $id = $row["ID"];
                $role = $row["role"];
                $post_count = $row["post_count"];
                $thread_count = $row["thread_count"];
                $avatar = $row["avatar"];
                if (!empty($avatar)) {
                    $avatar = "<img src='/phpForum/img/avatar/" . $avatar . "' id='avatar'>";
                } else {
                    $avatar = "none";
                }

                echo "<tr><td>$id</td><td>$username</td><td>$role</td><td>$post_count</td><td>$thread_count</td><td>$avatar</td></tr>";
            }
        }
    } else if (isset($_GET["name"])) {
        $user_name = $_GET["name"];
        $query = mysqli_query($CON, "SELECT * FROM user WHERE username LIKE '$user_name%'");
        $num = mysqli_num_rows($query);
        echo $num;
        if ($num == 0) {
            echo "error: no user found with that name<br>";
            echo "<a href='user.php'>back to search</a>";
            exit;
        } else {
            echo "<table border=1><tr><th>ID</th><th>name</th><th>role</th><th>post count</th><th>thread count</th><th>profile picture</th></tr>";
            while ($row = mysqli_fetch_assoc($query)) {
                $username = $row["username"];
                $id = $row["ID"];
                $role = $row["role"];
                $post_count = $row["post_count"];
                $thread_count = $row["thread_count"];
                $avatar = $row["avatar"];
                if (!empty($avatar)) {
                    $avatar = "<img src='/phpForum/img/avatar/" . $avatar . "' id='avatar'>";
                } else {
                    $avatar = "none";
                }
                echo "<tr><td>$id</td><td>$username</td><td>$role</td><td>$post_count</td><td>$thread_count</td><td>$avatar</td></tr>";
            }
        }
    }
}else {
    include("search_user.php");
}
?>
<thml>
    <head>
        <title>user search</title>
        <link rel="stylesheet" href="css/user.css">
    </head>
    <body>
    <a href="index.php">back to index</a>
    </body>
</thml>
