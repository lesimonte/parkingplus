<?php

$servername = "localhost";
  $username = "root";
  $password = "";
  $basedatos = "parking_plus_db";

  //crear una nueva conexion
  $conexion = new mysqli($servername, $username, $password, $basedatos);

  if ($conexion->connect_error) {

    die("la conexion a la base de datos tuvo error" . $conexion->connect_error);
  }
