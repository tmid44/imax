<?php
    setcookie('user', $user['name'], time() - 3600 * 6, "/");
    setcookie('id', $user['id_user'], time() - 3600 * 6, "/");  
    header('Location: /log.php');
?>