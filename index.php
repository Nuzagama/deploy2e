<h1>¡Welcome!</h1>
<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("location: login.php");
        exit;
    }
    echo "Has iniciado sesión como {$_SESSION["usuario"]}";
    
?>

<h4><a href="logout.php">Logout</a></h4>