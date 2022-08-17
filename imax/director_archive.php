<?php
include "valid/databases.php";
include "valid/classes.php";

$result = mysqli_query($induction,"SELECT * FROM `director`");

while ($director=mysqli_fetch_assoc($result)){
    $posts[]=$director;
}


$searched_director = filter_var(trim($_POST['searched_director']), FILTER_SANITIZE_STRING);
$searched_director =mb_strtolower($searched_director);

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
  
                    <li class="active centered"><a href="#" >Архів</a>
                    <ul class="nav lefted">
                        <li><a href="film_archive.php">Фільми</a></li>
                        <li><a href="actor_archive.php">Актори</a></li>
                        <li><a href="director_archive.php">Режисери</a></li>
                    </ul></li>


                    <li><a href="log.php">Профіль</a></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="container mt-4">
        <h1 class="search">Пошук режисерів</h1>
        <form action="director_archive.php" method="post">
            <input type="text" class="form-control search_film" name="searched_director"
            id="searched_director" placeholder="Введіть ім'я або прізвище режисера"><br>
            <button class="btn btn-outline-dark btn-lg btn-block" type="submit" >Пошук</button>
        </form>
    </div>





    <div class="films">
        <div class="container mt-4">

            <?php
            if($searched_director=="")
            {
            foreach ($posts as $director)
            { 
                $t_director= new Director($director['name'],$director['surname'],$director['bdate'],$director['img'],$director['info']);

                ?>
            <div class="main">

                <div class="row searched">
                    <div class="col-md-6">
                        <div class="title">
                            <h3> <?php $t_director->PrintNameSur() ; ?>  </h3>
                            <p> <?php 
                            $t_date=date("d.m.y",strtotime($t_director->bdate));
                            $dateDiff = date_diff(new DateTime(), new DateTime($t_director->bdate))->y;
                            echo $t_date. "  (". $dateDiff ."  років)"; ?> </p>
                            <p><?php echo $t_director->dInfo; ?></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="image">
                            <img src="img/directors/<?php echo $t_director->dImg;?>" alt="">
                        </div>
                    </div>

                    

                    <hr>

                </div>
                <br>
            </div>
            <?php
            }  
        }
        else
        {
            foreach ($posts as $director)
            {
                $t_director= new Director($director['name'],$director['surname'],$director['bdate'],$director['img'],$director['info']);

                $lowerN=mb_strtolower($t_director->name);
                $lowerS=mb_strtolower($t_director->surname);
                if($searched_director==$lowerN || $searched_director==$lowerS)
                {
                    ?>
                    <div class="main">

                    <div class="row searched">
                        <div class="col-md-6">
                            <div class="title">
                                <h3> <?php $t_director->PrintNameSur() ; ?>  </h3>
                                <p> <?php 
                                $t_date=date("d.m.y",strtotime($t_director->bdate));
                                $dateDiff = date_diff(new DateTime(), new DateTime($t_director->bdate))->y;
                                echo $t_date. "  (". $dateDiff ."  років)"; ?> </p>
                                <p><?php echo $t_director->dInfo; ?></p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="image">
                                <img src="img/directors/<?php echo $t_director->dImg;?>" alt="">
                            </div>
                        </div>
                        <hr>
                    </div>
                    <br>
                    </div>

        <?php
        }}}
        ?>

        </div>
    </div>
    
</body>
</html>