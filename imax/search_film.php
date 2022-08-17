<?php
include "valid/databases.php";

$result = mysqli_query($induction,"SELECT * FROM `movie`");

while ($film=mysqli_fetch_assoc($result)){
    $posts[]=$film;
}


$searched_film = filter_var(trim($_POST['searched_film']), FILTER_SANITIZE_STRING);
// while ($film=mysqli_fetch_assoc($result))
// {
//     echo $film['name'];
//     echo "<br>";
// }

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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- <script src="js/search_script.js"></script> -->
    <script>
  $( function() {
    <?php
        foreach ($posts as $film){
            $names[]=$posts['name'];
        }
        
        $js_array = json_encode($names);
    ?>
    
    $( "#film" ).autocomplete({
      source: js_array;
      //availableTags
    });
  } );
  </script>
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

                    <li class="active"><a href="search_film.php" >Пошук</a></li>
  
                    <li><a href="#" >Архів</a>
                    <ul class="nav">
                        <li><a href="film_archive.php">Фільми</a></li>
                        <li><a href="actor_archive.php">Актори</a></li>
                        <li><a href="#">Режисери</a></li>
                    </ul></li>
                    <li><a href="#">Профіль</a></li>
                </ul>
            </div>
        </div>
    </div>



    <div class="container mt-4">
        <h1 class="search">Пошук фільмів</h1>
        <form action="valid/search_film.php" method="post">
            <input type="text" class="form-control search_film" name="searched_film"
            id="searched_film" placeholder="Введіть назву фільму"><br>
            <button class="btn btn-outline-dark btn-lg btn-block" type="submit" >Пошук</button>
        </form>
    </div>


    <script src="js/search_script.js"></script>
    
    
</body>
</html>