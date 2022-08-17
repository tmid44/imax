<?php

    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $surename = filter_var(trim($_POST['surename']), FILTER_SANITIZE_STRING);
    $bdate = $_POST['bdate'];
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
    
    if(mb_strlen($name) < 2 || mb_strlen($name) > 40){
        echo "Неправильна довжина імені";
        exit();
    } else if(mb_strlen($surename) < 3 || mb_strlen($surename) > 40){
        echo "Неправильна довжина прізвища";
        exit();
    } else if(mb_strlen($login) < 4 || mb_strlen($login) > 20){
        echo "Неправильна довжина логіна";
        exit();
    } else if(mb_strlen($pass) < 4 || mb_strlen($pass) > 20){
        echo "Неправильна довжина пароля (від 4 до 20 символів)";
        exit();
    }

    $pass=md5($pass."tllcswe25d6");

    include "databases.php";

    $result = mysqli_query($induction,"SELECT `login` FROM `user`");

    while ($log=mysqli_fetch_assoc($result)){
        $posts[]=$log;
    }

    $check=0;
    foreach ($posts as $log)
    {
        if($log['login']==$login)
        {
            $check=1; 
        }
    }

    if($check==0){
    $mysql = new mysqli('127.0.0.1','root','','movies');

    


    $mysql->query("INSERT INTO `user` (`name`,`surname`,`bdate`,`login`,`pass`) VALUES('$name','$surename','$bdate','$login','$pass')");

    $mysql->close();

    header('Location: /log.php');
    }
    else
    {
       // echo "<script>alert(\"Диний логін вже занятий(\");</script>"; 
       echo "<script>alert(\"Диний логін вже занятий(\");</script>"; 
    //    header('Location: /register.html');
    }
?>