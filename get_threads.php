<?php
session_start();
include("db.php");

$page = $_GET["page"];
$offset = $page*10;
$query = mysqli_query($CON, "SELECT * FROM threads ORDER BY ID DESC LIMIT 10 OFFSET $offset ");

echo '<table>
        <tr>
            <th width="30px">ID</th>
            <th>title</th>
            <th width="100px">owner</th>
            <th width="200px">date</th>
        </tr>';

while($row = mysqli_fetch_assoc($query)){
    $id = $row["ID"];
    $owner = $row["owner"];
    $owner = "<a href='/phpForum/user.php?name=$owner'>$owner</a>";
    $title = $row["title"];
    $date = $row["date"];
    echo "<tr><td>".$id."</td>"."<td><a href='/phpForum/showthread.php?id=".$id."'>".$title."</a></td>"."<td>".$owner."</td><td>".$date."</td></tr>";
}
?>