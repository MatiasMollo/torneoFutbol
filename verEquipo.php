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

//Restringimos caracteres HTML (Aunque no es necesario en este caso)
$idEquipo = htmlspecialchars($_GET['id']);


//Taemos data del equipo
$sql = "SELECT * FROM equipos WHERE ID=? LIMIT 1";
$consulta = $conn->prepare($sql);
$consulta->bind_param('i',$idEquipo);
$consulta->execute();
$equipo = mysqli_fetch_assoc($consulta->get_result());

//Traemos los jugadores
$sql = "SELECT * FROM jugadores WHERE equipo=?";
$consulta = $conn->prepare($sql);
$consulta->bind_param("i",$idEquipo);
$consulta->execute();
$jugadores = mysqli_fetch_all($consulta->get_result());

//Traemos al staff
$sql = "SELECT * FROM staff WHERE equipo=?";
$consulta = $conn->prepare($sql);
$consulta->bind_param("i",$idEquipo);
$consulta->execute();
$staff = mysqli_fetch_all($consulta->get_result());


//Puntos del equipo
$puntosEquipo = 0;
$puntosEquipo += intval($equipo['pg']) * 3;
$puntosEquipo += intval($equipo['pe']);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/verEquipo.css" >
    <title>Equipo <?= $equipo['nombre'] ?></title>
</head>
<body class="bg-dark container w-100 row mx-auto p-0">
    <div class="container mx-auto mt-5 col-11 col-lg-10 col-xxl-8 container row">
        <h1 class="title display-3 fw-bold text-light text-center mb-3 mx-auto mt-auto"><?= $equipo['nombre'] ?></h1>
        <div class="container mb-4 p-0">
            <h1 class="text-light">Historia</h1>
            <p class="text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti doloribus eum a eos enim autem asperiores totam, dicta tempora earum excepturi quaerat, esse nulla facilis officia quia ducimus sed molestiae. Similique, laborum. Quaerat rem cupiditate ducimus. Error adipisci voluptatibus corporis consectetur cumque maiores voluptas explicabo? Ex sint minima maxime. Facere numquam mollitia tenetur aut molestias id alias quos. Autem eos, quod numquam minima fugit dignissimos tempore sequi voluptatem quos tenetur alias voluptates omnis delectus. Iusto tenetur repellendus sint dicta harum itaque dolores ullam, delectus in. Ratione quaerat obcaecati excepturi. Minus vel ut nostrum delectus similique. Harum error quas non amet.</p>
        </div>
        <div class="insightContainer col-12 col-sm-10 col-xxl-11 container row border-top pt-2 mx-auto">
                <div class="container p-0 col-12 col-xl-5 container-estadisticas">
                    <h1 class="text-light mb-3 mt-2 text-estadisticas">Estadísticas</h1>
                    <h5 class="bg-primary text-start col-11 mx-auto rounded text-light p-2" ><?= $equipo['pj'] ?> Partidos jugados</h5>
                    <h5 class="bg-primary text-start col-11 mx-auto rounded text-light p-2"><?= $equipo['pg'] ?> Partidos ganados</h5>
                    <h5 class="bg-primary text-start col-11 mx-auto rounded text-light p-2"><?= $equipo['pe'] ?> Partidos empatados</h5>
                    <h5 class="bg-primary text-start col-11 mx-auto rounded text-light p-2"><?= $equipo['pp'] ?> Partidos perdidos</h5>
                    <h5 class="bg-primary text-start col-11 mx-auto rounded text-light p-2"><?= $equipo['gf'] ?> Goles a favor</h5>
                    <h5 class="bg-primary text-start col-11 mx-auto rounded text-light p-2"><?= $equipo['gc'] ?> Goles en contra</h5>
                    <h5 class="bg-success text-start col-11 mx-auto rounded text-light p-2"><?= $puntosEquipo ?> Puntos en el torneo</h5>
                </div>
                <div class="container d-flex row p-2 mx-auto col-xl-5 container-jugadores">
                    <h1 class="text-light text-jugadores">Jugadores</h1>
                <?php foreach($jugadores as $jugador): ?>
                    <p class="bg-light col-11 mx-auto p-1 rounded mx-1 mt-2 mb-0 pe-3"><?= $jugador[1] . " " . $jugador[2] ?> (<?php echo ucwords($jugador[5]) ?>)</p>
                <?php endforeach; ?>
            </div>
            <div class="staffDiv col-12 col-lg-6 container row p-2 mx-auto">
                <h1 class="title text-light pb-2">Staff</h1>
                <?php foreach($staff as $personal): ?>
                    <p class="bg-light p-1 rounded mb-2 col-11 mx-auto"><?= $personal[1] . " " . $personal[2] ?> (<?php echo ucwords($personal[7]) ?>)</p>
                <?php endforeach; ?>
            </div>
        </div>
        <a href="fechas.php" class="btn btn-secondary mb-5 col-6 col-sm-3 mx-auto btn-volver">Volver</a>
    </div>
</body>
</html>