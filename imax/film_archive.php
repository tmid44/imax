<?php
include "valid/databases.php";
include "valid/classes.php";

$result = mysqli_query($induction,"SELECT * FROM `movie`");

while ($film=mysqli_fetch_assoc($result)){
    $posts[]=$film;
}

$result_act = mysqli_query($induction,"SELECT * FROM `actor`");

while ($actor=mysqli_fetch_assoc($result_act)){
    $posts_act[]=$actor;
}

$result_dir = mysqli_query($induction,"SELECT * FROM `director`");

while ($director=mysqli_fetch_assoc($result_dir)){
    $posts_dir[]=$director;
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
    <title>Пошук фільмів</title>

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
        <h1 class="search">Пошук фільмів</h1>
        <form action="film_archive.php" method="post">
            <input type="text" class="form-control search_film" name="searched_film"
            id="searched_film" placeholder="Введіть назву фільму або рік випуску"><br>
            <button class="btn btn-outline-dark btn-lg btn-block" type="submit" >Пошук</button>
        </form>
    </div>





    <div class="films">
        <div class="container mt-4">

            <?php
            if($searched_film=="")
            {
            foreach ($posts as $film)
            { 
                foreach ($posts_act as $actor)
                {
                    if($film['actor']==$actor['id_actor'])
                        $t_actor=new Actor($actor['name'],$actor['surname'],$actor['bdate'],$actor['img'],$actor['video']);
                }

                foreach ($posts_dir as $director)
                {
                    if($film['director']==$director['id_director'])
                        $t_director= new Director($director['name'],$director['surname'],$director['bdate'],$director['img'],$director['info']);
                }

                $t_film= new Movie($film['name'],$film['year'],$film['contry'],$film['genre'],$film['timing'],$film['budget'],$film['trailer'],$film['poster'],$film['descr'],$t_actor,$t_director);
                ?>
            <div class="main">

                <div class="row searched">
                    <div class="col-md-6">
                        <div class="image">
                            <img src="img/posters/<?php echo $t_film->mPoster;?>" alt="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="title">
                            <h3 name="responsed_film" id="responsed_film" > <?php $t_film->PrintName(); ?>  </h3>
                            <p> <?php echo $t_film->mYear. ",   ". $t_film->mContry ; ?> </p>
                            <p> <?php echo $t_film->mGenre ; ?> </p>
                            <p> <?php echo $t_film->mTiming. "  хв." ?> </p>
                            <p> Режисер:  <?php $t_director->PrintNameSur(); ?> </p>
                            <p> Головний актор:  <?php $t_actor->PrintNameSur(); ?> </p>
                            <p> <?php echo $t_film->mDescr; ?> </p>
                            
                        </div>
                        <a href="<?php echo $film['trailer']; ?>" class="youtube" target="_blank">Перегляд трейлеру на Youtube</a>
                        <p></p>
                        <form action="response.php" method="post">
                        <select class="invis" name="responsed_film">
                            <option value=<?php echo $film['id_movie']; ?>><?php echo $film['id_movie']; ?></option>
                        </select>
                            <button class="btn btn-outline-dark btn-lg btn-block" type="submit" >Відгук</button>
                        </form>
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
            foreach ($posts as $film)
            { 
                foreach ($posts_act as $actor)
                {
                    if($film['actor']==$actor['id_actor'])
                        $t_actor=new Actor($actor['name'],$actor['surname'],$actor['bdate'],$actor['img'],$actor['video']);
                }

                foreach ($posts_dir as $director)
                {
                    if($film['director']==$director['id_director'])
                        $t_director= new Director($director['name'],$director['surname'],$director['bdate'],$director['img'],$director['info']);
                }

                $t_film= new Movie($film['name'],$film['year'],$film['contry'],$film['genre'],$film['timing'],$film['budget'],$film['trailer'],$film['poster'],$film['descr'],$t_actor,$t_director);
 
                $lowerF=mb_strtolower($t_film->mName);
                if($searched_film==$lowerF || $searched_film==$t_film->mYear)
                {
                    ?>
                    <div class="main">

                <div class="row searched">
                    <div class="col-md-6">
                        <div class="image">
                            <img src="img/posters/<?php echo $t_film->mPoster;?>" alt="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="title">
                            <h3> <?php $t_film->PrintName(); ?>  </h3>
                            <p> <?php echo $t_film->mYear. ",   ". $t_film->mContry ; ?> </p>
                            <p> <?php echo $t_film->mGenre ; ?> </p>
                            <p> <?php echo $t_film->mTiming. "  хв." ?> </p>
                            <p> Режисер:  <?php $t_director->PrintNameSur(); ?> </p>
                            <p> Головний актор:  <?php $t_actor->PrintNameSur(); ?> </p>
                            <p> <?php echo $t_film->mDescr; ?> </p>
                        </div>
                        <a href="<?php echo $film['trailer']; ?>" class="youtube" target="_blank">Перегляд трейлеру на Youtube</a>
                        
                        <p></p>
                        <form action="response.php" method="post">
                        <select class="invis" name="responsed_film">
                            <option value=<?php echo $film['id_movie']; ?>><?php echo $film['id_movie']; ?></option>
                        </select>
                            <button class="btn btn-outline-dark btn-lg btn-block" type="submit" >Відгук</button>
                        </form>

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