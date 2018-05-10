<?php
  include("access.php");
  include("SetDB.php");
  $setDB = new ConectorBD($host,$user,$password);

  if($setDB->initConexion($database) == "OK"){
    $tabla["nombre"] = "user";
    $campos["campo1"] = "username";
    $campos["campo2"] = "password";
    $condicion = 'WHERE username="'.$_POST['username'].'"';

    $resultado = $setDB->consultar($tabla,$campos,$condicion);
    if ($resultado->num_rows != 0) {
      $fila = $resultado->fetch_assoc();
      if (password_verify($_POST['password'], $fila['password'])) {
        $response['msj'] = 'OK';
        session_start();
        $_SESSION['username']=$fila['username'];
      }
      else {
        $response['msj'] = 'Contraseña incorrecta';
      }
    }
    else{
      $response['msj'] = 'Email incorrecto';
    }
  }

  echo json_encode($response);

  $setDB->cerrarConexion();

?>
