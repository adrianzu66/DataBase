<?php
  include("access.php");
  include("SetDB.php");
  $setDB = new ConectorBD($host,$user,$password);
  session_start();
  if($setDB->initConexion($database) == "OK"){
    $tabla = "event";
    $campos["username"] = $_POST['username'];
    $campos["title"] = $_POST['title'];
    $campos["start"] = $_POST['start_date'];
    $campos["end"] = $_POST['end_date'];
    $campos["startHour"] = $_POST['start_hour'];
    $campos["endHour"] = $_POST['end_hour'];
    $campos["complet"] = $_POST['allDay'];

    $condicion = 'WHERE username="'."usuario1@gmail.com".'"';
    $resultado = $setDB->insertData($tabla,$campos);
    //$response['msg']= $resultado;
    if($resultado == TRUE){
      $response['msg']= 'OK';
    }
    else{
      $response['msg']= 'Error al insertar data';
    }

  }
  else{
    $response['msg'] = 'Error con la base de datos';
  }

  echo json_encode($response);

  $setDB->cerrarConexion();
?>
