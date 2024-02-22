<?php
$nombrepagina="Nuevo Ingreso";
 include 'plantilla.php'; 
 include 'header.php'; 
?>

<div class="contenedor-nuevo-ingreso">
  <form action="" id="nuevoIngreso">
    <h3>informacion del vehiculo</h3>

    <div class="control-form">
      <label>Tipo Vehiculo</label>
      <select>
        <option value="">Carro</option>
        <option value="">Moto</option>
        <option value="">Otro</option>
      </select>
    </div>

    <div class="control-form">
      <label>Marca</label>
      <input type="text" id="Marca">
    </div>
    <div class="control-form">
      <label>Color</label>
      <input type="text" id="Color">
    </div>
    <div class="control-form">
      <label>Placa</label>
      <input type="text" id="Placa">
    </div>
    <div class="control-form">
      <label>Observaciones</label>
      <input type="text" id="Observaciones">
    </div>
    <button class="botonNuevoVehiculo">Ingresar Vehiculos</button>

  </form>

</div>

<?php include 'footer.php'; ?>