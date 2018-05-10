<?php
  include("access.php");
  include("SetDB.php");

  // //create Database
  $conexion = new mysqli($host,$user,$password);
  if($conexion->connect_error){
    echo "Error ".$conexion->connect_error;
  }
  else {
    echo "Conexion OK       ";
  }

  $sql = "CREATE DATABASE ".$database;
  if ($conexion->query($sql) == TRUE) {
    echo "Database ".$database." created.         ";
  }
  else {
    echo $conexion->error;
  }
  $conexion->close();

  //conexion
  $setDB = new ConectorBD($host,$user,$password);

  //tabla user
  if($setDB->initConexion($database) == "OK"){
    $tableName = "user";
    $campos["username"]= "VARCHAR(50)";
    $campos["nombre"] = "VARCHAR(100)";
    $campos["password"] = "VARCHAR(500)";
    $campos["fechaNacimiento"] = "DATE";
    //build query
    $result = $setDB->newTable($tableName,$campos);
    echo $result;
  }
  else {
    $setDB->initConexion();
  }

  //tabla evento
  if($setDB->initConexion($database) == "OK"){
    $tableName = "event";
    $campos["id"]= "INT";
    $campos["username"]= "VARCHAR(50)";
    $campos["title"] = "VARCHAR(100)";
    $campos["start"] = "DATE";
    $campos["end"] = "DATE";
    $campos["startHour"] = "VARCHAR(50)";
    $campos["endHour"] = "VARCHAR(50)";
    $campos["complet"] = "VARCHAR(6)";
    //build query
    $result = $setDB->newTable($tableName,$campos);
    echo $result;
  }
  else {
    $setDB->initConexion();
  }

  //primary key event
  if($setDB->initConexion($database) == "OK"){
    $tableName = "event";
    $key= "ADD PRIMARY KEY (id)";
    //build query
    $result = $setDB->nuevaRestriccion($tableName,$key);
    echo $result;
  }
  else {
    $setDB->initConexion();
  }

  //autoincrement
  if($setDB->initConexion($database) == "OK"){
    $tableName = "event";
    $key= "MODIFY id INTEGER NOT NULL AUTO_INCREMENT;";
    //build query
    $result = $setDB->nuevaRestriccion($tableName,$key);
    echo $result;
  }
  else {
    $setDB->initConexion();
  }

  //primary key user
  if($setDB->initConexion($database) == "OK"){
    $tableName = "user";
    $key= "ADD PRIMARY KEY (username)";
    //build query
    $result = $setDB->nuevaRestriccion($tableName,$key);
    echo $result;
  }
  else {
    $setDB->initConexion();
  }

  //nuevaRelacion
  if($setDB->initConexion($database) == "OK"){
    //build query
    $result = $setDB->nuevaRelacion("event","user","username", "username");
    echo $result;
  }
  else {
    $setDB->initConexion();
  }

?>
