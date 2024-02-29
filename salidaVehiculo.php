<?php
$nombrepagina = "Salida Vehículo";
include 'plantilla.php';
include 'header.php';
include 'conexionbasedatos.php';

// Establecer la zona horaria a "America/Bogota"
date_default_timezone_set('America/Bogota');

// Definir variable para comprobar si se ha realizado la consulta
$consultaRealizada = false;

// Verificar si se ha enviado el formulario y la placa está presente
if (isset($_POST['placa'])) {
    // Escapar el texto de la placa para prevenir inyección SQL
    $placa = $conexion->real_escape_string($_POST['placa']);

    // Consulta SQL para obtener la información del vehículo
    $consulta = "SELECT * FROM vehiculos WHERE placa = '$placa' AND estado = 'parqueado'";
    $resultado = $conexion->query($consulta);

    // Comprobar si se encontraron resultados
    if ($resultado && $resultado->num_rows > 0) {
        // Mostrar la información del vehículo
        $vehiculo = $resultado->fetch_assoc();
        $consultaRealizada = true;

        // Calcular tiempo transcurrido
        $fechaHoraIngreso = new DateTime($vehiculo['fechaHoraIngreso']);
        $fechaHoraActual = new DateTime(); // Fecha y hora actual
        $intervalo = $fechaHoraIngreso->diff($fechaHoraActual);

        // Calcular el total de minutos transcurridos
        $minutosTranscurridos = ($intervalo->days * 24 * 60) +
            ($intervalo->h * 60) +
            $intervalo->i;

        // Determinar la tarifa según el tipo de vehículo
        if ($vehiculo['tipoVehiculo'] == 'carro') {
            $tarifaPorHora = 3000;
        } else {
            $tarifaPorHora = 2000;
        }

        // Calcular el total a pagar
        $totalHoras = floor($minutosTranscurridos / 60); // Obtener la parte entera de las horas
        $totalMinutosRestantes = $minutosTranscurridos % 60; // Obtener los minutos restantes
        $totalPagar = ($totalHoras * $tarifaPorHora) + (($totalMinutosRestantes > 0) ? $tarifaPorHora : 0);

        // Formatear el tiempo transcurrido para mostrarlo
        $tiempoTranscurrido = sprintf("%d hora(s), %d minuto(s)", $totalHoras, $totalMinutosRestantes);
    }
}

?>

<div class="contenedor-salida-vehiculo">
    <h3>Salida del vehículo</h3>

    <div class="buscador">
        <form action="" method="post">
            <label style="margin-top: 15px;">Placa:</label>
            <input name="placa" type="text" placeholder="Ingresa la placa del vehículo sin espacios">
            <button>Buscar</button>
        </form>
    </div>

    <?php
    if ($consultaRealizada) {
        // Mostrar la información del vehículo
        echo '<div class="informacion">
            <div class="izquierda">Vehículo</div>
            <div class="derecha disenoPlaca">' . $vehiculo['placa'] . '</div>
            <div class="izquierda">Fecha y Hora de Ingreso</div>
            <div class="derecha">' . $vehiculo['fechaHoraIngreso'] . '</div>
            <div class="izquierda">Tiempo transcurrido</div>
            <div class="derecha">' . $tiempoTranscurrido . '</div>
            <div class="izquierda">Total a Pagar</div>
            <div class="derecha">$' . $totalPagar . ' COP</div>
        </div>';

        // Formulario para enviar el total a pagar al servidor
        echo '<form action="procesar_cobro.php" method="post">
        <div class="botones-acciones">
            <input type="hidden" name="totalPagar" value="' . $totalPagar . '">
            <input type="hidden" name="placa" value="' . $placa . '">
            <button type="submit" name="cobrar" class="btnAccion btnCobrar">Cobrar</button>
            <button class="btnAccion btnCancelar">
                <a href="salidaVehiculo.php">Cancelar</a>
            </button>
        </div>            
        </form>';

    } elseif (isset($_POST['placa'])) {
        echo '<div class="mensaje">No se encontró ningún vehículo con esa placa.</div>';
    }
    if (isset($conexion)) {
        $conexion->close();
    }
    ?>

</div>

<?php include 'footer.php'; ?>