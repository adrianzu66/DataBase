<?php
  include("access.php");
  include("SetDB.php");
  $setDB = new ConectorBD($host,$user,$password);
  session_start();
  if($setDB->initConexion($database) == "OK"){
    $tabla = "event";
    //$campos["id"] = $_POST['id'];
    $campos["start"] = "'".$_POST['start_date']."'";
    $campos["end"] = "'".$_POST['end_date']."'";
    $campos["startHour"] = "'".$_POST['start_hour']."'";
    $campos["endHour"] = "'".$_POST['end_hour']."'";
    $condicion = 'id="'.$_POST['id'].'"';

    $resultado = $setDB->actualizarRegistro($tabla,$campos,$condicion);
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
