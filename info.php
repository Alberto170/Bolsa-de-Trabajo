<?php
include('conexion.php');

$queryNacionalidad = "SELECT nacionalidad FROM Nacionalidades WHERE cveNacionalidad = nacionalidad";
$resultNacionalidad = mysqli_query($conexion, $queryNacionalidad);
$rowNacionalidad = mysqli_fetch_array($resultNacionalidad);

?>

<p>Nacionalidad</p>
<input onkeyup="buscarAhora($('#nacionalidad').val());" type="text" name="nacionalidad" id="nacionalidad">
<h2 id="nacionalidadResultado" name="nacionalidadResultado"><?php echo $rowNacionalidad["nacionalidad"];?></h2>


<script type="text/javascript">
    function buscarAhora(buscar) {
        var parametros = {"nacionalidad": nacionalidad}
        $.ajax({
            data: parametros,
            type: 'POST',
            url: 'info.php',
            success: function(data) {
                document.getElementById("nacionalidadResultado").innerHTML = data;
            }
        })
    }
</script>