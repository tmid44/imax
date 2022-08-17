<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат пошуку фільмів</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-targer=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="main.html">IMAX</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="main.html">Головна</a></li>

                    <li class="active"><a href="search_film.html" >Пошук</a></li>
  
                    <li><a href="#">Історія кіно</a></li>
                    <li><a href="#">Профіль</a></li>
                </ul>
            </div>
        </div>
    </div>

<style>
    .result{
    font-size: xx-large;
    margin-top: 200px;
    margin-left: 90px;
}
</style>
<?php
    $film = $_POST['film'];
    
    $mysql = new mysqli('localhost','root','','register-bd');

    $result = $mysql->query("SELECT * FROM `movie` WHERE `name` = '$film'");

    $films = $result->fetch_assoc();

     if(count($films)==0){
         echo "Такого фільма не існує(";
         exit();
     }

    // php  echo "{$films['name']}   {$films['year']}   {$films['contry']}";  
     //<!-- <a class=\"result\">     </a> -->
    
     echo "<div class=\"result\">{$films['name']}</div>";
   

    $mysql->close();

     //header('Location: /search_film.php');

     return $films;
?>

</body>
</html>
