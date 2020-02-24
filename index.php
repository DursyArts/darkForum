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
<script>
    window.onload = function() {
        page(0);
    };

    function page(page) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("ajaxTable").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "/phpForum/get_threads.php?page="+page, true);
        xhttp.send();

        document.getElementById("pagination-active").innerHTML = "page"+page+" :";
    }
</script>
<body>
<div class="nav">
        <div class="nav-logo">
            <h3>dark forum v1</h3>
        </div>
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
            <a href="/phpForum/crypter.php">crypter</a>
        </div>
        <div class="nav-spacer"></div>
</div>
<div class="forum-posts">
    <table id="ajaxTable">
        <!-- Gets filled by JS Ajax request from get_threads.php?page=x -->
    </table>
    <div class="pagination_id" >
        <p id="pagination-active" style="display: inline;">page:</p>
            <?php
        $query = mysqli_query($CON, "SELECT * FROM threads");
        $num = mysqli_num_rows($query);
        $limit = 10;
        $pages = ceil($num/$limit);
        $pages--;

        for($i=0;$i<=$pages;$i++){
            echo "<a href='#' id='pagination' onclick='page($i)'>$i</a>";
        }
        ?>

    </div>

</div>
<div class="marquee">
    <marquee direction="down" width="100%" height="100%" behavior="alternate" style="color: lime;">
        <marquee behavior="alternate" >
            Under<br>Construction!
        </marquee>
    </marquee>
</div>
</body>
</html>
