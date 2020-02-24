<?php
if(isset($_POST["search"])){
    $sf = $_POST["radio"]; //sf = search for name or id
    $var = $_POST["input"];
    $string = "Location: user.php?".$sf."=".$var;
    header($string);
}
?>
<style>
    body{
        background: black;
        color: lime;
        font-family: Courier, sans-serif;
    }
    input{
        background: black;
        color: lime;
        outline: none;
        border: 1px solid lime;
    }
</style>
<form action="user.php" method="POST">
    <table style="padding: 5px;">
        <tr>
            <td><label><input type="radio" name="radio" id="sf_id" value="id" checked>search for id</label></td>
            <td><label><input type="radio" name="radio" id="sf_name" value="name">search for name</label></td>
        </tr>
        <tr>
            <td colspan="2"><label>name/id: <input type="text" name="input"></label></td>
        </tr>
        <tr >
            <td colspan="2">
                <input type="submit" name="search" id="search" value="search">
            </td>
        </tr>
    </table>

</form>