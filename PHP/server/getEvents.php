<?php
  include("access.php");
  include("SetDB.php");
  $setDB = new ConectorBD($host,$user,$password);
  session_start();
  if($setDB->initConexion($database) == "OK"){
    $tabla["nombre"] = "event";
    $campos["campo1"] = "id";
    $campos["campo2"] = "title";
    $campos["campo3"] = "start";
    $campos["campo4"] = "end";
    $campos["campo5"] = "startHour";
    $campos["campo6"] = "endHour";
    $campos["campo7"] = "complet";
    $condicion = 'WHERE username="'.$_POST['username'].'"';
    //$condicion = 'WHERE username="'."usuario1@gmail.com".'"';
    $resultado = $setDB->consultar($tabla,$campos,$condicion);
    if ($resultado->num_rows != 0) {
      $i=0;
      $arr =  array();
      while ($fila = $resultado->fetch_assoc()) {

        if($fila["complet"] == "true"){
          $result = [
            "id" => $fila['id'],
            "title" => $fila['title'],
            "start" => $fila['start'],
            "end" => $fila['end'],
            "allDay" => $fila['complet']
          ];
        }
        else {
          $result = [
            "id" => $fila['id'],
            "title" => $fila['title'],
            "start" => $fila['start']."T".$fila['startHour'],
            "end" => $fila['end']."T".$fila['endHour'],
            "allDay" => $fila['complet']
          ];
        }

        array_push($arr,$result);
      }
      $res = 'OK';
      $response = [
        "events" => $arr,
        "msg" => $res
      ];
    }
    else{
      $arr =  array();
      $result = [
        "id" => "0",
        "title" => " ",
        "start" => "1988-01-01",
        "end" => "1988-01-01",
        "allDay" => "false"
      ];
      array_push($arr,$result);
      $res = 'OK';
      $response = [
        "events" => $arr,
        "msg" => $res
      ];
    }

  }
  else{
    $response['msg'] = 'Error con la base de datos';
  }

  echo json_encode($response);

  $setDB->cerrarConexion();
?>
