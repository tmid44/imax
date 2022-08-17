<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="bootstrap/all.min.css"> -->
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" href="css/reg_style.css">
    <title>Log in</title>
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
                    <li><a href="main.html">Головна</a></li>

                    <!-- <li><a href="search_film.php" >Пошук</a></li> -->


                    <li><a href="#" >Архів</a>
                    <ul class="nav">
                        <li><a href="film_archive.php">Фільми</a></li>
                        <li><a href="actor_archive.php">Актори</a></li>
                        <li><a href="director_archive.php">Режисери</a></li>
                    </ul></li>
                        

                    <!-- <li><a href="#" >Архів</a></li>
                        <option value="Фільми"></option> -->
                    <li class="active"><a href="log.php">Профіль</a></li>
                </ul>
            </div>
        </div>
    </div>


    <?php 
    if($_COOKIE['user']==''){
    ?>

    <div class="container mt-4">
        <h1>Форма авторизації</h1>
        <form action="valid/auth.php" method="post">
            <input type="text" class="form-control" name="login"
            id="login" placeholder="Введіть логін"><br>
            <input type="password" class="form-control" name="pass"
            id="pass" placeholder="Введіть пароль"><br>
            <button class="btn btn-success" type="submit">Увійти</button>
            <a href="register.html" class="log">Створити акаунт</a>
        </form>

        <?php  
    }
    else
    header('Location: /profile.php');
        ?>

</body>
</html>