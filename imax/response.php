<?php
    $responsed_film = ($_POST['responsed_film']);

    include "valid/databases.php";
    include "valid/classes.php";

    $result_film = mysqli_query($induction,"SELECT * FROM `movie`");
    
    while ($film=mysqli_fetch_assoc($result_film)){
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

    $responses = mysqli_query($induction,"SELECT * FROM `response`");
    
    while ($response=mysqli_fetch_assoc($responses)){
        $posts_response[]=$response;
    }

    $result_user = mysqli_query($induction,"SELECT * FROM `user`");
    
    while ($usr=mysqli_fetch_assoc($result_user)){
        $posts_user[]=$usr;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Відгук</title>
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
        <p></p>
        <h1>Відгуки</h1>
    </div>

    <div class="films">
        <div class="container mt-4">

            <?php 
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

                    if($film['id_movie']==$responsed_film){

                    $t_film= new Movie($film['name'],$film['year'],$film['contry'],$film['genre'],$film['timing'],$film['budget'],$film['trailer'],$film['poster'],$film['descr'],$t_actor,$t_director);
                    //  $name, $year, $contry,$genre, $timing,$budget, $trailer,$poster, $descr
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
                                <?php  $film_id=$film['id_movie'];  ?>
                                <p> <?php echo $t_film->mTiming. "  хв." ?> </p>
                                <p> Режисер:  <?php $t_director->PrintNameSur(); ?> </p>
                                <p> Головний актор:  <?php $t_actor->PrintNameSur(); ?> </p>
                                <p> <?php echo $t_film->mDescr; ?> </p>
                            </div>
                            <a href="<?php echo $film['trailer']; ?>" class="youtube" target="_blank">Перегляд трейлеру на Youtube</a>
                        </div>
                        <hr>
                    </div>
                    <br>
                </div>
                <?php
                    }}  ?>
        </div>
    </div>




    <?php if($_COOKIE['user']!=''){ ?>
    <div class="container mt-4">
        <h3 class="search">Створити відгук</h3>
        <form action="valid/add_response.php" method="post">
            <textarea name="response" class="form-control search_film lefted" id="response" cols="30" rows="10" placeholder="Введіть свій відгук" ></textarea>
            <br>
            <select class="invis" name="res_film">
                <option value=<?php echo $film_id; ?>><?php echo $film_id; ?></option>
            </select>
            <select class="invis" name="res_user">
                <option value=<?php echo $_COOKIE['id']; ?>><?php echo $_COOKIE['id']; ?></option>
            </select>
            <button class="btn btn-outline-dark btn-lg btn-block" type="submit" > Додати</button>
            <br>
            <br>
        </form>
    </div>
    <?php } ?>







    <div class="container mt-4">

            <?php 
                foreach ($posts_response as $response)
                { 
                    if($response['film']==$responsed_film)
                    {
                        foreach ($posts_user as $usr)
                        {
                            if($response['user']==$usr['id_user'])
                                $t_user= new User($usr['name'],$usr['surname'],$usr['bdate'],$usr['login'],$usr['pass']);
                        }
                        $t_response= new Response($t_user,$response['film'],$response['text']);
                    ?>
                <div class="main">
    
                    <div class="row searched">
                        <div class="col-md-2">
                            <h3><?php $t_response->rUser->PrintNameSur(); ?></h3>
                        </div>
    
                        <div class="col-md-10 response_txt">
                            <div class="title">
                                <p><?php echo $t_response->rText; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
                    }}  ?>
        </div>



</body>
</html> 