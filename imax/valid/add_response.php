<?php

    $response=$_POST['response'];
    $film=$_POST['res_film'];
    $user=$_POST['res_user'];

    $mysql = new mysqli('127.0.0.1','root','','movies');

    $mysql->query("INSERT INTO `response` (`user`,`film`,`text`) VALUES('$user','$film','$response')");

    $mysql->close();

    header('Location: /film_archive.php');


?>