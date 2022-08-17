<?php
include "valid/databases.php";
include "valid/classes.php";

$result = mysqli_query($induction,"SELECT * FROM `movie`");

while ($film=mysqli_fetch_assoc($result)){
    $posts[]=$film;
}

$responses = mysqli_query($induction,"SELECT * FROM `response`");
    
while ($response=mysqli_fetch_assoc($responses)){
    $posts_response[]=$response;
}

$result_user = mysqli_query($induction,"SELECT * FROM `user`");
    
while ($usr=mysqli_fetch_assoc($result_user)){
    $posts_user[]=$usr;
}

$searched_film = filter_var(trim($_POST['searched_film']), FILTER_SANITIZE_STRING);
$searched_film =mb_strtolower($searched_film);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script> -->
    <!-- <script src="js/search_script.js"></script> -->
    
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
                <ul class="nav navbar-nav navbar-right navbar_menu">
                    <li ><a href="main.html">Головна</a></li>

                    <!-- <li ><a href="search_film.php" >Пошук</a></li> -->
  
                    <li class="centered"><a href="#" >Архів</a>
                    <ul class="nav lefted">
                        <li><a href="film_archive.php">Фільми</a></li>
                        <li><a href="actor_archive.php">Актори</a></li>
                        <li><a href="director_archive.php">Режисери</a></li>
                    </ul></li>


                    <li class="active"><a href="log.php">Профіль</a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php 
    if($_COOKIE['user']==''){
        header('Location: /log.php');
    }
    else {
    ?>



    <div class="container mt-4">
        <h2>Ви увійшли в акаунт</h2>
        <h1 class="search">Привіт, <?php echo $_COOKIE['user'] ?>  </h1>
        <p>Щоб вийти з акаунта нитисніть <a href="valid/exit.php">тут</a></p>
        
    </div>




    <?php 
        }
            ?>
       

    
</body>
</html>