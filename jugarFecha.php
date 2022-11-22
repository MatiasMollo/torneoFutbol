<?php 

session_start();
include "tools/dbConnect.php";

//Validaciones
if(empty($_SESSION['user']->id) || $_SESSION['user']->id != 1 || 
   empty($_GET['id']) || empty($_GET['E1']) || empty($_GET['E2'])){

    header('location:./');
    die();
}

$idPartido = $_GET['id'];
$E1 = $_GET['E1'];
$E2 = $_GET['E2'];

//Validaciones de IDs
if(!($idPartido > 0 && $idPartido < 16) ||
   !($E1 > 0  && $E1 < 7) ||
   !($E2 > 0 && $E2 < 7)){
    header('location:./');
    die();
}

$sql = "SELECT * FROM equipos WHERE ID=? || ID=? LIMIT 2";
$consulta = $conn->prepare($sql);
$consulta->bind_param("ii",$E1,$E2);
$consulta->execute();
$equipos = mysqli_fetch_all($consulta->get_result());

$sql = "SELECT ID FROM partidos";
$consulta = $conn->query($sql);
$partido = mysqli_fetch_all($consulta);

if(count($partido) == 0) $partido = 1;
else $partido = count($partido)+1;

//! Probar si funciona para el desempate

//Verificamos que la ID de la URL coincida con los partidos en la DB
if($idPartido != $partido){
    header('location:./');
    die();
}

$sql = "SELECT * FROM jugadores WHERE equipo=? || equipo=?";
$consulta = $conn->prepare($sql);
$consulta->bind_param('ii',$E1,$E2);
$consulta->execute();
$jugadores = mysqli_fetch_all($consulta->get_result());


//! RESTRINGIR CARACTERES HTML

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
    <script defer src="scripts/jugarFecha.js"></script>
    <title><?php echo $equipos[0][1] . " VS " . $equipos[1][1] ?></title>
</head>
<body class="bg-dark">
    <form class="mx-auto w-50 bg-light p-3 rounded mt-3">
        <div class="teamsContainer d-flex">
            <?php foreach($equipos as $i => $equipo): ?>
            <div class="divEquipo divEquipo-<?= $i ?>">
                <input type="hidden" value="<?= $i . "=" . $equipo[0] ?>" class="equipo">
                <h1 class="m-2"><?= $equipo[1] ?></h1>
                <label for="goles-<?= $i?>" class="m-2">Goles</label>
                <input type="number" id="goles-<?= $i ?>" class="goles goles-<?= $i ?> w-25" value="0" key="<?= $i ?>" min="0">
                <h4 class="m-2">Goleador/es</h4>
                <?php foreach($jugadores as $jugador): ?>
                    <?php if($jugador[8] == $equipo[0]): //Verificamos que el equipo del jugador coincida con el equipo que se esta mostrando (si no los duplica)?>
                    <div class="golesJugador row m-1">
                        <h6 class="col-4 w-75" key="<?= $i . "=" . $jugador[0] ?>"><?= $jugador[1] . " " . $jugador[2] . " (" . ucwords($jugador[5]) . ")"?></h6>
                        <input type="number" key="<?= $i . "=" . $jugador[0] ?>" min="0" value="0" class="col-2 jugador jugador-<?= $i ?>" >
                        <?php //!Hacerlo con keys y tomarlo con JS 
                        ?>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <button class="btn btn-primary mx-auto d-flex mt-3 subir">Subir</button>
    </form>
</body>
</html>