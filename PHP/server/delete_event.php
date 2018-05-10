<?php
  include("access.php");
  include("SetDB.php");
  $setDB = new ConectorBD($host,$user,$password);
  session_start();
  if($setDB->initConexion($database) == "OK"){
    $tabla = "event";
    $condicion = 'id="'.$_POST['id'].'"';

    $resultado = $setDB->eliminarRegistro($tabla,$condicion);
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
