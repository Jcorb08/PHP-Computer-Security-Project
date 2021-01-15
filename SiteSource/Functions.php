<?php
// Functions.php
// 198735

function getConnectionData($check){
    $file = fopen('../src/Data.txt', "r") or die("File unavailable!");
    $server = preg_replace('/\s+/', '', fgets($file));
    $db = preg_replace('/\s+/', '', fgets($file));
    $table = preg_replace('/\s+/', '', fgets($file));
    while(!feof($file)){
        $user = preg_replace('/\s+/', '', fgets($file));
        $pass = preg_replace('/\s+/', '', fgets($file));
        if ($check == 1){
            break;
        }
        else if ($check == 2){
            $user = preg_replace('/\s+/', '', fgets($file));
            $pass = preg_replace('/\s+/', '', fgets($file));
            break;
        }       
    }
    return array($server, $db, $table, $user, $pass);
}

function getConnection($check){
    $Data = getConnectionData($check);
    //echo $Data[0] . $Data[1] . $Data[2] .$Data[3] .$Data[4];
    $connect = new mysqli($Data[0], $Data[3], $Data[4], $Data[1]);
    //new mysqli($host, $username, $passwd, $dbname)
    //check connection
    if ($connect->connect_error){
        die("Connection Failed! -> " . $connect->connect_error);
    }
    return array($connect, $Data[2]);
}

function filterData($data){
    return htmlspecialchars(stripslashes(trim($data)));
}

//Functions.php
//198735
function headerCSP(){
    header("Content-Security-Policy: default-src 'self' computersecuritycoursework.ml www.google.com www.gstatic.com;");
    header("Set-Cookie: samesite=; path=/; domain=localhost; HttpOnly; SameSite=Lax");

}

function tokenGen(){

    if(!isset($_SESSION["token"])){
        //gen new
        $token = md5(uniqid(rand(), true));
        $_SESSION['token'] = $token;
    }
    else{
        //reuse
        $token = $_SESSION["token"];
    }
    return $token;
}

function tokenCheck(){   
    if (isset($_SESSION['token']) && ($_POST["token"] != $_SESSION["token"])){
        //reset token
        unset($_SESSION["token"]);
        die("token failed!");
    }
}

function getreCaptcha($key){
    $file = fopen('../src/reCaptcha.txt', "r") or die("File unavailable!");
    $captcha = preg_replace('/\s+/', '', fgets($file));
    if ($key == 2){
        $captcha = preg_replace('/\s+/', '', fgets($file));
    }
    return $captcha;
}

function checkreCaptcha(){
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
    
    $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='. 
            getreCaptcha(2).'&response='.$_POST['g-recaptcha-response']);
    if(json_decode($verify)->success){
        echo 'Verification Success <br/>';
    }
    else{
        die('reCaptcha verification failed');
    }    
}
else{
    die('reCaptcha verification needs to be checked');
}
}

