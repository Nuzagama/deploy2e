<?php

    require 'database.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["nombre"]) && isset($_POST["contrasena"])) {

            $nombre = $_POST["nombre"];
            $contrasena = $_POST["contrasena"];
    
            $sql = "SELECT usuario, contrasena FROM usuarios WHERE usuario='$nombre'";
            $resultado = $conexion -> query($sql);

            var_dump($resultado);
            echo "<p>". $resultado -> num_rows ."</p>";
    
            if ($resultado != false && $resultado -> num_rows > 0) {
                echo "<p>Estamos aquí</p>";
                while($row = $resultado -> fetch_assoc()) {
                    $hash_contrasena = $row["contrasena"];
                }
                $auth = password_verify($contrasena, $hash_contrasena);
                var_dump($auth);
                if ($auth) {
                    echo "<p>Autenticación correcta</p>";
                    session_start();
                    $_SESSION["usuario"] = $nombre;
                    echo "Has iniciado sesión como {$_SESSION["usuario"]}";
                    header("location: index.php");
                    exit;
                } else {
                    echo "Contraseña incorrecta";
                }
            }
        }
    }

?>

<h1>Iniciar sesión</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" accept-charset="utf-8">
    Nombre: <input type="text" name="nombre">
    <span class="error">* <?php if (isset($err_nombre)) echo $err_nombre;?></span>
    <br><br>
    Contraseña: <input type="password" name="contrasena">
    <span class="error">* <?php if (isset($err_contrasena)) echo $err_contrasena;?></span>
    <br><br>
    <input type="submit" value="Enviar">
</form>
<h4><a href="registrarse.php">Registrarse</a></h4>
