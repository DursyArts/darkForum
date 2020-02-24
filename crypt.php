<?php
session_start();
include("db.php");

function private_crypt($method,$str,$given_key){
    $encrypt_method         =   'AES-256-CBC';
    if(isset($given_key)){
        $private_key = $given_key;
    }else{
        $private_key            =   'm6kof9Y70kj5SMdo5GoH'; // dont leak
    }

    $private_iv             =   '12d668da07dac038f24d4db0f6bff677'; // dont leak

    $key                    =   hash('sha256',$private_key);
    $iv                     =   substr(hash('sha256', $private_iv),0,16);

    if($method == 'e'){
        $output = openssl_encrypt($str,$encrypt_method,$key,0,$iv);
        $output = base64_encode($output);
    }else if($method == 'd'){
        $output = openssl_decrypt(base64_decode($str),$encrypt_method,$key,0,$iv);
    }else{
        $output = 'NULL';
    }

    if($str == ""){
        $output = "NULL";
    }

    return $output;
}
$method = $_GET["m"];
$string = $_GET["s"];
$given_key = $_GET["k"];

$str = private_crypt($method,$string,$given_key);

echo $str;
