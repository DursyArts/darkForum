<?php
include("db.php");
session_start();

?>
<html lang="en">
<head>
    <title>Crypter v1.0</title>
</head>
<script>
    window.onload = function () {
        document.getElementById("result-string").style.background = "#db634b";
    };

    function crypt(){
        var m = document.getElementsByName("m");
        for(var i=0, length = m.length; i<length;i++){
            if(m[i].checked){
                var method = m[i].value;
                break;
            }
        }
        var string = document.getElementById("string").value;
        var key = document.getElementById("key").value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("result-string").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "/phpForum/crypt.php?m="+method+"&s="+string+"&k="+key, true);
        xhttp.send();
        document.getElementById("string").value = "";
        document.getElementById("result-string").style.background = "#3e8016";
    }
</script>
<style>
    body{
        font-family: Courier, sans-serif;
    }

    .wrapper{
        left: 0;
        height: 80vh;
        display: flex;
        flex-direction: column;
    }

    .crypt{
        order: 0;
    }

    .result{
        position: relative;
        order: 1;
        height: fit-content;
        word-break: break-all;

    }

    .result p{
        margin-top: -1em;
        background: #3e8016;
        padding: 1em;
    }

    table{
        text-align: center;
    }
</style>
<body>
<h3>javascript&html won't be sanitized!</h3>
<h4>using AES-256-CBC</h4>
<div class="wrapper">
    <div class="crypt">
        <table>
            <tr><th width="150px">function</th><th>string/key</th><th width="150px">submit</th></tr>
            <tr>
                <td>
                    <input type="radio" name="m" value="e" id="encrypt" checked>
                    <label for="e">encrypt</label>
                </td>
                <td>
                    <input type="text" placeholder="string" name="s" id="string" autocomplete="off">
                </td>
                <td>
                    <input type="submit" onclick="crypt();">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="m" value="d" id="decrypt">
                    <label for="d">decrypt</label>
                </td>
                <td>
                    <input type="text" placeholder="key(not required)" name="key" id="key" autocomplete="off">
                </td>
                <td>
                    <a href="index.php">back to index</a>
                </td>
            </tr>
            <tr>
                <td colspan="3">not using a key will result in using a server side hardcoded key!</td>
            </tr>

        </table>

        <div class="result">
            <h4>Result:</h4>
            <p id="result-string">NULL</p>
        </div>
    </div>
</div>
</body>
</html>
