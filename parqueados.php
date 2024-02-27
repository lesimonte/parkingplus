<?php
$nombrepagina = "parqueados";
include "plantilla.php";
include "header.php";

$servername = "localhost";
  $username = "root";
  $password = "";
  $basedatos = "parking_plus_db";

//crear una nueva conexion
$conexion = new mysqli($servername, $username, $password, $basedatos);
if ($conexion->connect_error) {

    die("la conexion a la base de datos tuvo error" . $conexion->connect_error);
  }
//consultar los vehiculos parqueados
$vehiculosparqueados = "SELECT * FROM vehiculos WHERE estado = 'parqueado'";
$resultado = $conexion->query($vehiculosparqueados);

// obtener los datos como un array multidimencional
$vehiculos=$resultado->fetch_all(MYSQLI_ASSOC);
?>

<div class="contenedor-listado-parqueados">
 <h3>Vehiculos Parqueados</h3>
    <table class="tabla">
        <thead>
            <tr>
                <th>placa</th>
                <th>ingreso</th>
            </tr>
        </thead>
        <?php
            if(!empty($vehiculos)) {
                foreach($vehiculos as $vehiculo) {
                    echo"<tr>";
                    echo "<td>";
                    if ($vehiculo["tipoVehiculo"]== "carro") {
                        echo "<i class='fa-solid fa-car'></i>";
                    }elseif ($vehiculo["tipoVehiculo"]== "moto"){
                            echo "<i class='fa-solid fa-motorcycle'></i>";
                        }else {
                            echo "<i class='fa-solid fa-bullseye'></i>";
                        }
                    echo"<td>". $vehiculo["tipoVehiculo"] ."</td>";

                    echo"<td>". $vehiculo["placa"] ."</td>";
Ñ
                    echo"<td>". $vehiculo["fechaHoraIngreso"] ."</td>";
                    echo"</tr>";
                }
            } else{
                echo "<tr><td cosplan='5'>No Hay parqueados </tr></td>";
            }
            ?>
  </table>
</div>

<?php include 'footer.php'; ?>