<?php

session_start();
include "dbConnect.php";

//Validaciones 
if(empty($_SESSION['user']->id) || $_SESSION['user']->id != 1 || empty($_POST['json'])){

    header('location:../');
    die();
}

$data = json_decode($_POST['json']);

$sqlEquipo = "SELECT * FROM equipos WHERE ID=? LIMIT 1";
$traerEquipo = $conn->prepare($sqlEquipo);

$sqlJugadores = "UPDATE jugadores SET goles=? WHERE ID=?";
$actualizarJugador = $conn->prepare($sqlJugadores);

$sqlEquipo = "UPDATE equipos SET pj=?,pg=?,pe=?,pp=?,gf=?,gc=?,puntos=? WHERE ID=?";
$actualizarEquipo = $conn->prepare($sqlEquipo);

$ganador = null; // Variable para almacenar id del ganador

foreach($data as $i => $equipo){

    //Traemos los datos del equipo segun ID
    $traerEquipo->bind_param('i',$equipo->equipo); 
    $traerEquipo->execute();
    $equipoDB = mysqli_fetch_assoc($traerEquipo->get_result());

    $pj = intval($equipoDB["pj"]) + 1; //Partidos jugados
    $pg = intval($equipoDB["pg"]);
    $pe = intval($equipoDB['pe']);
    $pp = intval($equipoDB['pp']);

    $puntosEquipo = intval($equipoDB['puntos']);

    if($i == 0){
        if($equipo->goles > $data[1]->goles) $ganador = $equipo->equipo; //idEquipo
        else if($data[1]->goles > $equipo->goles) $ganador = $data[1]->equipo;
    }
    if($ganador == null){ //Si ganador es nulo empataron
        $pe++;
        $puntosEquipo++;
    } 
    else if($ganador == $equipo->equipo){ //Caso contrario si el ganador es el Id del equipo en curso se le suma a pg
        $pg++;
        $puntosEquipo += 3;
    } 
    else $pp++; //Caso contrario a los anteriores, el partido se perdio y se suma 1 a PP

    $gf = $equipo->goles;
    $gc = $i == 0 ? $data[1]->goles : $data[0]->goles; //Sacamos los goles en contra dependiendo del bucle

    // recorremos cada goleador y lo actualizamos en la DB
    if(count($equipo->goleadores) > 0){
        foreach((array) $equipo->goleadores as $goleador){
            $actualizarJugador->bind_param('ii',$goleador->goles,$goleador->idJugador);
            $actualizarJugador->execute();
        }
    }

    //Actualizamos las estadisticas del equipo
    $actualizarEquipo->bind_param('iiiiiiii',$pj,$pg,$pe,$pp,$gf,$gc,$puntosEquipo,$equipo->equipo);
    $actualizarEquipo->execute();

}

$sqlPartido = "INSERT INTO partidos (ID_equipoA,ID_equipoB,goles_equipoA,goles_equipoB) VALUES (?,?,?,?)";
$consultaPartido = $conn->prepare($sqlPartido);
$consultaPartido->bind_param('iiii',$data[0]->equipo,$data[1]->equipo,$data[0]->goles,$data[1]->goles);
$consultaPartido->execute();

echo "TODO OK";

//! RESTRINGIR CARACTERES HTML

