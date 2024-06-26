<?php
    $editing = false;
    $edit_id = null;

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
            <h2>Registro</h2>
            <form method="POST">

                <label for="usuario">Usuario:</label><br>
                <input type="text" id="usuario" name="usuario" required><br><br>

                <label for="contrasena">Contraseña:</label><br>
                <input type="text" id="contrasena" name="contrasena" required><br><br>
                
                <button type="submit" name="btnregistrar" value= "ok" >Registrar</button>
                <!--  -->
                <?php
                  if(!empty($_POST["btnregistrar"])){
                    //   echo "boton registrar presionado u.u, ";
                      
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
        <!--  -->
        <?php if (!empty($_GET["edit_id"])){ ?>
        <div class="formulario">
            <h2>Actualización</h2>

            <?php
                $edit_id = $_GET["edit_id"];
                $result = $conexion->query("SELECT * FROM usuario WHERE id=$edit_id");
                $user = $result->fetch_assoc();
            ?>

            <form method="POST">
                <input type="hidden" name="edit_id" value="<?= $edit_id ?>">
                <label for="edit_usuario">Usuario:</label><br>
                <input type="text" id="edit_usuario" name="edit_usuario" value="<?= $user['nameUser'] ?>" required><br><br>

                <label for="edit_contrasena">Contraseña:</label><br>
                <input type="text" id="edit_contrasena" name="edit_contrasena" value="<?= $user['password'] ?>" required><br><br>
                
                <button type="submit" name="btnactualizar" value="ok">Actualizar</button>
            </form>

            <?php
            if (!empty($_POST["btnactualizar"])) {
                if (!empty($_POST["edit_usuario"]) && !empty($_POST["edit_contrasena"])) {
                    $edit_usuario = $_POST["edit_usuario"];
                    $edit_contrasena = $_POST["edit_contrasena"];
                    $edit_id = $_POST["edit_id"];

                    $sql = $conexion->query("UPDATE usuario SET nameUser='$edit_usuario', password='$edit_contrasena' WHERE id=$edit_id");
                    if ($sql == 1) {
                        echo 'Usuario actualizado';
                    } else {
                        echo 'Error al actualizar';
                    }
                } else {
                    echo "Por favor, complete todos los campos.";
                }
            }
            ?>
        </div>
        <?php }?>

        <div class="tabla">
            
        <?php
            if(!empty($_GET["id"])){
                $id=$_GET["id"];

                $sql=$conexion->query("delete from usuario where id=$id");
                if ($sql==1) {
                    echo 'Usuario eliminado';
                } else {
                    echo 'Error al eliminar';
                }
            }
        ?>

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
                            <a href="index.php?edit_id=<?= $datos->id ?>">Editar</a>
                            <a href="index.php?id=<?= $datos->id ?>">Eliminar</a>
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