<?php

function captcha_verify(){
    if(empty($_POST['g-recaptcha-response'])){
        echo 'Captcha is required';
    }
    else{
        $secret_key = '6LcKktsUAAAAAFJ3zy-s7wuZ8WYUlcshLtqfYBsR';

        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);

        $response_data = json_decode($response);

        if(empty($response_data)){
            echo 'Captcha is required';
        }else{
            return "solved";
        }
    }
}
