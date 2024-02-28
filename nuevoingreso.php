<?php
$nombrepagina = "Nuevo Ingreso";
include 'plantilla.php';
include 'header.php';
include 'conexionbasededatos.php';

// verificar si se a enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  //CAPTURAR DATOS DEL FORMULARIO
  $tipoVehiculo = $_POST["tipoVehiculo"];
  $marca = $_POST["marca"];
  $color = $_POST["color"];
  $placa = $_POST["placa"];
  $observaciones = $_POST["observaciones"];
  //conexion a la base de datos

  $servername = "localhost";
  $username = "root";
  $password = "";
  $basedatos = "parking_plus_db";

  //crear una nueva conexion
  $conexion = new mysqli($servername, $username, $password, $basedatos);

  if ($conexion->connect_error) {

    die("la conexion a la base de datos tuvo error" . $conexion->connect_error);
  }

  //armar la consulta para la conexion
  $insertar = "INSERT INTO vehiculos (tipovehiculo, marca, color, placa, observaciones)
  VALUES ('$tipoVehiculo','$marca','$color','$placa','$observaciones')";

  //ejecutar consulta
  if ($conexion->query($insertar) === TRUE) {
    //Redirigir al archivo exito.php despues de la insercion en la base de datos
    header("Location:exito.php");
    exit;
    
  } else {
    echo "Error:" . $insertar . "<br>" . $conexion->error;
  }


  // cerrar la conexion
  $conexion->close();
}
?>

<div class="contenedor-nuevo-ingreso">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="nuevoIngreso" method="post">
    <h3>informacion del vehiculo</h3>

    <div class="control-form">
      <label>Tipo Vehiculo</label>
      <select name="tipoVehiculo">
        <option value="carro">Carro</option>
        <option value="Moto">Moto</option>
        <option value="Otro">Otro</option>
      </select>
    </div>

    <div class="control-form">
      <label>Marca</label>
      <input type="text" id="Marca" name="marca" />
    </div>
    <div class="control-form">
      <label>Color</label>
      <input type="text" id="Color" name="color" />
    </div>
    <div class="control-form">
      <label>Placa</label>
      <input type="text" id="Placa" name="placa" />
    </div>
    <div class="control-form">
      <label>Observaciones</label>
      <input type="text" id="observaciones" name="observaciones" />
    </div>
    <button class="botonNuevoVehiculo" type="submit">Ingresar Vehiculos</button>

  </form>

</div>

<?php include 'footer.php'; ?>