<?php
session_start();
include("db.php");
?>
<html lang="en">
<head>
    <title>Forum index</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
<div class="nav">
    <div class="nav-content">
        <p>dark forum v1</p>
        <div class="nav-links">
            <?php
            if(isset($_SESSION["sessionname"])){
                echo $_SESSION["sessionname"];
                echo " <a href='/phpForum/logout.php'>logout</a>";
            }else{
                echo "<a href='/phpForum/login.php'>login</a>";
                echo " <a href='/phpForum/register.php'>register</a>";
            }

            ?>

            <a href="user.php">user</a>
            <a href="create.php">create</a>
        </div>
    </div>
</div>
<div class="forum-posts">
    <table>
        <tr>
            <th width="30px">ID</th>
            <th>title</th>
            <th width="100px">owner</th>
            <th width="200px">date</th>
        </tr>
        <?php
        $query = mysqli_query($CON, "SELECT * FROM threads");
        while($row = mysqli_fetch_assoc($query)){
            $id = $row["ID"];
            $owner = $row["owner"];
            $title = $row["title"];
            $date = $row["date"];
            echo "<tr><td>".$id."</td>"."<td><a href='/phpForum/showthread.php?id=".$id."'>".$title."</a></td>"."<td>".$owner."</td><td>".$date."</td></tr>";
        }

        ?>

    </table>
</div>
</body>
</html>
