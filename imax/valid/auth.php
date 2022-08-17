<?php
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

    $pass=md5($pass."tllcswe25d6");

    $mysql = new mysqli('localhost','root','','movies');

    $result = $mysql->query("SELECT * FROM `user` WHERE `login` = '$login' AND `pass` = '$pass'");

    $user = $result->fetch_assoc();

    if(count($user)==0){
        echo "Такого користувача не існує(";
        exit();
    }

    setcookie('user', $user['name'], time() + 3600 * 6, "/");  
    setcookie('id', $user['id_user'], time() + 3600 * 6, "/");  

    $mysql->close();

    header('Location: /profile.php');
?>