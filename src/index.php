<?php
    // echo "hello2";
    $conexion = new mysqli( 'mysql_db', 'root' , 'root' , 'servidores');
    $conexion->set_charset("utf8");
    if($conexion){
    // echo "Connected !!!";
    ?>
    <script>
        console.log("Connected data base !!!");
    </script>
    <?php
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario y Tabla PHP</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
        }
        .formulario {
            width: 40%;
        }
        .tabla {
            width: 50%;
            border: 1px solid #ccc;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="formulario">
            <h2>Formulario</h2>
            <form method="POST">

                <label for="usuario">Usuario:</label><br>
                <input type="text" id="usuario" name="usuario" required><br><br>

                <label for="contrasena">Contraseña:</label><br>
                <input type="text" id="contrasena" name="contrasena" required><br><br>
                
                <button type="submit" name="btnregistrar" value= "ok" >Registrar</button>
                <?php
                 $conexion = new mysqli('mysql_db', 'root', 'root', 'servidores');
                 $conexion->set_charset("utf8");
                  if(!empty($_POST["btnregistrar"])){
                    if((!empty($_POST["usuario"]) and !empty($_POST["contrasena"]) )){
                      $usuario=$_POST["usuario"];
                      $contrasena=$_POST["contrasena"];

                      $sql=$conexion->query("insert into usuario(nameUser,password)values('$usuario','$contrasena')");
                      if ($sql==1) {
                        echo 'Usuario registrado';
                      } else {
                        echo 'Error al registrar';
                      }
                    //   echo "usuario: $usuario, ";
                    //   echo "contrasena: $contrasena";

                    }else{
                      echo "Noop 2";
                    }
                  }else{
                  }

                ?>
            </form>
        
        </div>
        <div class="tabla">
            <h2>Usuarios Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $sql=$conexion->query(" select * from usuario ");

                while($datos = $sql->fetch_object()){
                    ?>
                    <tr>
                        <td><?= $datos->id ?></td>
                        <td><?= $datos->nameUser ?></td>
                        <td><?= $datos->password ?></td>
                        <td>
                            <a href="">Editar</a>
                            <a href="">Eliminar</a>
                        </td>
                    </tr>
                   <?php
                }
                ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>