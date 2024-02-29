<?php
// Verificar si se recibieron los datos necesarios
if (isset($_POST['placa'], $_POST['totalPagar'])) {
    // Obtener los datos del formulario
    $placa = $_POST['placa'];
    $totalPagar = $_POST['totalPagar'];

    // Realizar cualquier validación adicional si es necesario

    // Aquí pondrías tu lógica para actualizar la base de datos con la salida del vehículo
    // Por ejemplo, una consulta SQL para actualizar el estado, fechaHoraSalida y valorCobro en la tabla vehiculos
    // Ten en cuenta que este es solo un ejemplo y debes adaptarlo a tu estructura de base de datos

    // Establecer la conexión con la base de datos (suponiendo que ya tienes esta parte configurada)
    include 'conexionbasedatos.php';

    // Escapar los valores para evitar inyección de SQL (suponiendo que estás usando MySQLi)
    $placa = $conexion->real_escape_string($placa);
    $totalPagar = $conexion->real_escape_string($totalPagar);

    // Actualizar el registro en la base de datos
    $consulta = "UPDATE vehiculos SET fechaHoraSalida = NOW(), estado = 'retirado', valorCobrado = '$totalPagar' WHERE placa = '$placa' AND estado = 'parqueado'";

    if ($conexion->query($consulta) === TRUE) {
        echo '<div class="verde">Cobro realizado correctamente.</div>';
    } else {
        echo "Error al realizar el cobro: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se recibieron los datos necesarios, mostrar un mensaje de error
    echo "Error: No se recibieron los datos necesarios para procesar el cobro.";
}
?>

<script>
    // Redirigir automaticamente después de 2 segundos
    setTimeout( function () {
        window.location.href = "salidaVehiculo.php";
    }, 2000);
</script>