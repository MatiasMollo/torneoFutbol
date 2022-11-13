<?php
session_start();
include "tools/dbConnect.php";

if(empty($_SESSION['user']->id)){
    header('location:./');
    die();
}

$equipos = [
    "Almirante Brown",
    "Lanus",
    "Boca Juniors",
    "Aldosivi",
    "River Plate",
    "San Lorenzo"
];

$nombrePersonas = [
    "Marino",
    "Mariano",
    "Matias",
    "Gustavo",
    "Javier",
    "Nicolas",
    "Octavio",
    "Ivan",
    "Ignacio",
    "Gabriel",
    "Michael",
    "Francisco",
    "Valentin",
    "Tomas"
];

$apellidoPersonas = [
    "Mollo",
    "Perez",
    "Gonzalez",
    "Guerrini",
    "Schnatz",
    "Esteban",
    "Navarro",
    "Alcalde",
    "Ubeda",
    "Olmo",
    "Corrales",
    "Campillo",
    "Vargas"
];

/*
// Equipos
$sql = "INSERT INTO equipos (nombre,pj,pg,pe,pp,gf,gc) VALUES (?,?,?,?,?,?,?)";
$consulta = $conn->prepare($sql);
$v = 0; // $v = $valor

foreach($equipos as $equipo){
    
    $consulta->bind_param("siiiiii",$equipo,$v,$v,$v,$v,$v,$v);
    $consulta->execute();
}*/

/*
// Jugadores

$sql = "INSERT INTO jugadores (nombre,apellido,fechaNacimiento,altura,puesto,peso,DNI,equipo) VALUES (?,?,?,?,?,?,?,?)";
$consulta = $conn->prepare($sql);
$equipo = 1;
$puesto = 1;

for($x=1;$x<61;$x++){

    //Genera nombres aleatorios
    $nombreJugador = $nombrePersonas[rand(0,count($nombrePersonas)-1)];
    $apellidoJugador = $apellidoPersonas[rand(0,count($apellidoPersonas)-1)];

    $año = rand(1997,2003);
    $mes = rand(1,12);
    $dia = rand(1,28);
    $fechaNacimiento = date("$año-$mes-$dia");

    $altura = rand(160,199) / 100;
    
    //Posicion en rombo - duplicado por los suplentes
    if($x%10<2) $puesto = 1; //Arqueros
    else if($x%10<4) $puesto = 2; //Defensores
    else if($x%10<8) $puesto = 3; //Delanteros
    else $puesto = 4; //Mediocampistas

    $peso = rand(65,95);
    $DNI = rand(42123546,45987253);

    $consulta->bind_param("sssdiiii",$nombreJugador,$apellidoJugador,$fechaNacimiento,$altura,$puesto,$peso,$DNI,$equipo);
    $consulta->execute();

    if($x%10==0 && $x>1) $equipo++;
}
*/

/*
//Staff

$sql = "INSERT INTO staff (nombre,apellido,fechaNacimiento,altura,puesto,peso,DNI,equipo) VALUES (?,?,?,?,?,?,?,?)";
$consulta = $conn->prepare($sql);

$equipo = 1;

for($x=1;$x<19;$x++){

    //Genera nombres aleatorios
    $nombreStaff = $nombrePersonas[rand(0,count($nombrePersonas)-1)];
    $apellidoStaff = $apellidoPersonas[rand(0,count($apellidoPersonas)-1)];

    $año = rand(1997,2003);
    $mes = rand(1,12);
    $dia = rand(1,28);
    $fechaNacimiento = date("$año-$mes-$dia");

    $altura = rand(160,199) / 100;
    

    if($x%3==0) $puesto = 3; //Medico
    else if($x%3==2) $puesto = 2; //Preparador fisico
    else $puesto = 1; //tecnico


    $peso = rand(65,95);
    $DNI = rand(40123546,42987253);

    $consulta->bind_param("sssdiiii",$nombreStaff,$apellidoStaff,$fechaNacimiento,$altura,$puesto,$peso,$DNI,$equipo);
    $consulta->execute();

    if($x%3==0 && $x>1) $equipo++;
}
*/
