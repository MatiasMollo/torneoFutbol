<?php

session_start();
include("tools/dbConnect.php");

if(empty($_SESSION['user']->id) || $_SESSION['user']->id != 1) {
    header('location:./');
    die();
}
if(empty($_GET['id']) || $_GET['id'] <= 0 || $_GET['id'] > 6){
    header('location:fechas.php');
    die();
}

$idEquipo = $_GET['id'];

//Taemos data del equipo
$sql = "SELECT * FROM equipos WHERE ID=$idEquipo LIMIT 1";
$consulta = $conn->query($sql);
$equipo = mysqli_fetch_assoc($consulta);

//Traemos los jugadores
$sql = "SELECT * FROM jugadores WHERE equipo=$idEquipo";
$consulta = $conn->query($sql);
$jugadores = mysqli_fetch_all($consulta);

//Traemos al staff
$sql = "SELECT * FROM staff WHERE equipo=$idEquipo";
$consulta = $conn->query($sql);
$staff = mysqli_fetch_all($consulta);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Equipo <?= $equipo['nombre'] ?></title>
</head>
<body class="bg-dark">
    <div class="container mx-auto w-50 mt-5">
        <h1 class="title text-light text-center"><?= $equipo['nombre'] ?></h1>
        <div class="insightContainer row d-flex">
            <div class="container w-25 p-3">
                <h4 class="badge bg-primary text-start w-100 " ><?= $equipo['pj'] ?> Partidos jugados</h4>
                <h4 class="badge bg-primary text-start w-100 "><?= $equipo['pg'] ?> Partidos ganados</h4>
                <h4 class="badge bg-primary text-start w-100 "><?= $equipo['pe'] ?> Partidos empatados</h4>
                <h4 class="badge bg-primary text-start w-100 "><?= $equipo['pp'] ?> Partidos perdidos</h4>
                <h4 class="badge bg-primary text-start w-100 "><?= $equipo['gf'] ?> Goles a favor</h4>
                <h4 class="badge bg-primary text-start w-100 "><?= $equipo['gc'] ?> Goles en contra</h4>
            </div>
            <div class="container w-50 mr-0 mx-auto ml-auto">
                <h4 class="text-light text-end">Jugadores</h4>
                <?php foreach($jugadores as $jugador): ?>
                    <p class="text-light text-end"><?= $jugador[1] ?> <?= $jugador[2] ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <p class="text-light">BOTON DE VOLVER!!</p>
</body>
</html>