<?php

  include("access.php");
  include("SetDB.php");
  $setDB = new ConectorBD($host,$user,$password);
  //crea usuario1
  if($setDB->initConexion($database) == "OK"){
    //set pass
    $password = password_hash('123456', PASSWORD_DEFAULT);
    //format fecha
    $formato = 'Y-m-d';
    //$fecha = DateTime::createFromFormat($formato, '1988-05-05');
    $fecha = '1988-05-05';
    $tableName = "user";
    $campos["username"]= "usuario1@gmail.com";
    $campos["nombre"]= "Adrian Zurita A";
    $campos["password"] = $password;
    $campos["fechaNacimiento"] = $fecha;

    //build query
    $result = $setDB->insertData($tableName,$campos);
    echo $result;
  }
  else {
    $setDB->initConexion();
  }

  //crea usuario2
  if($setDB->initConexion($database) == "OK"){
    //set pass
    $password = password_hash('654321', PASSWORD_DEFAULT);
    //format fecha
    $formato = 'Y-m-d';
    //$fecha = DateTime::createFromFormat($formato, '1988-05-05');
    $fecha = '1990-06-28';
    $tableName = "user";
    $campos["username"]= "usuario2@gmail.com";
    $campos["nombre"]= "Hany Cordon C";
    $campos["password"] = $password;
    $campos["fechaNacimiento"] = $fecha;

    //build query
    $result = $setDB->insertData($tableName,$campos);
    echo $result;
  }
  else {
    $setDB->initConexion();
  }

  //crea usuario3
  if($setDB->initConexion($database) == "OK"){
    //set pass
    $password = password_hash('1234567890', PASSWORD_DEFAULT);
    //format fecha
    $formato = 'Y-m-d';
    //$fecha = DateTime::createFromFormat($formato, '1988-05-05');
    $fecha = '1980-06-06';
    $tableName = "user";
    $campos["username"]= "usuario3@gmail.com";
    $campos["nombre"]= "Ricardo Perez";
    $campos["password"] = $password;
    $campos["fechaNacimiento"] = $fecha;

    //build query
    $result = $setDB->insertData($tableName,$campos);
    echo $result;
  }
  else {
    $setDB->initConexion();
  }
 ?>
