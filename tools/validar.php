<?php

session_start();

//Validamos que hayan completado el formulario
if(empty($_POST['user']) || empty($_POST['password'])){
    header('location:../');
    die();
}

//Validacion de usuario sin DB (Opcional)
if($_POST['user'] == "Arbitro" ||
  $_POST['password'] == '$2y$10$u9aK4lkEw6HWcpJAuyKUA.t5irDar/wb7gq.FbHAjcdLMarGgglp2'){ //Arbitro
    $_SESSION['user'] = (object)[
        "id" => 1,
        "name" => "Arbitro"
    ];
    header('location:../fechas.php');
  }
  else{ //Mandamos mensaje de error y redirigimos en caso que el ingreso haya fallado
    $_SESSION['message'] = (object)[
        "message" => "Error iniciando sesion, vuelva a intentarlo"
    ];
    header('location:../');
  }


  //! VALIDAR CARACTERES HTML
?>
