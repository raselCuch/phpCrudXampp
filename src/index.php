<?php
    // echo "hello2";
    $con = new mysqli( 'mysql_db', 'root' , 'root' , 'mysql');

    if($con){
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
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $usuario = $_POST['usuario'];
                $contrasena = $_POST['contrasena'];

                // Aquí puedes realizar la lógica para guardar los datos en una base de datos o mostrarlos en la tabla
                // Por ejemplo, podrías guardarlos en un archivo CSV, en una base de datos MySQL, etc.
                echo "$usuario";
                echo "$contrasena";
            } else {
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="usuario">Usuario:</label><br>
                <input type="text" id="usuario" name="usuario" required><br><br>
                <label for="contrasena">Contraseña:</label><br>
                <input type="password" id="contrasena" name="contrasena" required><br><br>
                <input type="submit" value="Registrar">
            </form>
            <?php
            }
            ?>
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
                    <!-- Puedes añadir filas dinámicamente con PHP si es necesario -->
                    <tr>
                        <td>1</td>
                        <td>usuario1</td>
                        <td>password1</td>
                        <td>
                            <button>editar</button>
                            <button>eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>usuario1</td>
                        <td>password1</td>
                        <td>
                            <button>editar</button>
                            <button>eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>