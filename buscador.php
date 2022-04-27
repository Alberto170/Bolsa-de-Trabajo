<?php
include("conexion.php");

        $queryNacionalidad = "SELECT nacionalidad FROM Nacionalidades WHERE cveNacionalidad = nacionalidad"; 
        $resultNacionalidad = mysqli_query($conexion, $queryNacionalidad);
        $rowNacionalidad = mysqli_fetch_array($resultNacionalidad);
?>

<h1>Encontrado</h1>
<?php while($rowNacionalidad){ ?>
    <h1><?php echo $rowNacionalidad["nacionalidad"];?></h1>

<?php } ?>