<?php
include("conexion.php");
$msg = ""; //Cambiar los mensajes de error
$idQuery = ""; //Llena el campo id con el id de la tabla en html
$nameQuery = ""; //Llena el campo name con el name de la tabla en html
$id = $_POST['id']; //id hare referencia a la clave de la tabla actual
$name = trim($_POST['name']); //name hare referencia al campo nombre de la tabla actual
// Variables de nombre de tabla y campos de tabla
$table = "Perfiles";
$firstField = "cvePerfil";
$secondField = "perfil";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Bolsa de Trabajo</title>
</head>

<body>

    <?php
    // ALTA
    if (isset($_POST["alta"])) {
        $consulta = "SELECT * FROM $table WHERE $firstField = '$id' || $secondField = '$name'";
        $resultado = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_array($resultado);
        if ($row > 0) {
            $msg .= "<h4 class = 'text-danger text-center mt-4' >Ya existe la clave y/o nombre.</h4>";
        } elseif (strlen($id) >= 1 && strlen($name) >= 1) {
            $consulta = "INSERT INTO $table($firstField, $secondField) VALUES ('$id', '$name')";
            $resultado = mysqli_query($conexion, $consulta);
            $msg .= "<h4 class = 'text-success text-center mt-4'>Alta realizada con exito.</h4>";
        } else {
            $msg .= "<h4 class = 'text-danger text-center mt-4' >Llene todos los campos por favor</h4>";
        }
    }

    // BAJA
    if (isset($_POST["baja"])) {
        $consulta = "SELECT * FROM $table WHERE $firstField = '$id' && $secondField = '$name'";
        $resultado = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_array($resultado);
        if ($row > 0) {
            $delete = "DELETE FROM $table WHERE $firstField = '$id'";
            $resultado = mysqli_query($conexion, $delete);
            $msg .= "<h4 class = 'text-success text-center mt-4'>Baja realizada con exito.</h4>";
        } else {
            $msg .= "<h4 class = 'text-danger text-center mt-4' >No existe registro a eliminar.</h4>";
        }
    }
    
    // CONSULTA
    if (isset($_POST["consulta"])){
        if (strlen($id) >= 1){
            $consulta = "SELECT * FROM $table WHERE $firstField = '$id'";
            $resultado = mysqli_query($conexion, $consulta);
            $getConsulta = mysqli_fetch_array($resultado);
            if ($getConsulta > 0) {
                $idQuery = $getConsulta[$firstField];
                $nameQuery = $getConsulta[$secondField];
                $msg .= "<h4 class = 'text-success text-center mt-4'>Consulta realizada con exito.</h4>";
            } else {
                $msg .= "<h4 class = 'text-danger text-center mt-4' >No existe el registro que quiere consultar.</h4>";
            }
        } else {
            $msg .= "<h4 class = 'text-danger text-center mt-4' >No existe el registro que quiere consultar.</h4>";
        }
    }

    //MODIFICACION     
    if (isset($_POST["modificar"])) {
        $consulta = "SELECT * FROM $table WHERE $firstField = '$id'";
        $resultado = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_array($resultado);
        if ($row > 0 && $name != "") {
            $update = "UPDATE $table SET $secondField = '$name' WHERE $firstField = '$id'";
            $resultado = mysqli_query($conexion, $update);
            $msg .= "<h4 class = 'text-success text-center mt-4'>Registro modificado con exito.</h4>";
        } else {
            $msg .= "<h4 class = 'text-danger text-center mt-4' >No existe registro a modificar.</h4>";
        }
    }
    ?>

    <!-- Inicio del HTML FORM -->
    <h1>Bolsa de Trabajo</h1>
    <h2>Catalogos</h2>
    <h2>Catalogo de Perfiles</h2>
    <form action="Perfiles.php" method="POST" name="form" id="form">
        <div class="container-form">
            <!-- CAMBIAR LOS PLACEHOLDES POR NOMBRE DE CATALOGO -->
            <label for="id">Clave</label>
            <input type="text" name="id" id="id" placeholder="clave" class="form-control my-3 w-25" value="<?php echo htmlspecialchars($idQuery); ?>">
            <label for="name">Perfil</label>
            <input type="text" name="name" id="name" placeholder="perfil" class="form-control my-3" value="<?php echo htmlspecialchars($nameQuery); ?>">
        </div>
        <div class="container-btn">
            <button class="btn btn-primary" type="submit" name="alta">Alta</button>
            <button class="btn btn-primary" type="submit" name="baja">Baja</button>
            <button class="btn btn-primary" type="submit" name="modificar">Modificar</button>
            <button class="btn btn-primary" type="submit" name="consulta">Consulta</button>
            <a href="index.html" class="btn btn-danger btn-lg" role="button">Salir</a>
        </div>
        <!-- msg son los mensajes de errores para la validacion -->
        <?php echo $msg; ?>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>

</html>