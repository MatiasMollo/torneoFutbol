<?php 

session_start();
include "tools/dbConnect.php";

if(empty($_SESSION['user']->id) || $_SESSION['user']->id != 1) {
    header('location:./');
    die();
}

$sql = "SELECT * FROM equipos";
$consulta = $conn->query($sql);
$equipos = mysqli_fetch_all($consulta);

//Info de los partidos para bloquear las fechas que no corresponden (definir el numero y fecha del partido por el ID del mismo)
$sql = "SELECT * FROM partidos";
$consulta = $conn->query($sql);
$partidos = mysqli_fetch_all($consulta);


if(count($partidos) > 0) $idPartido = count($partidos)+1; //Cuenta cuantos partidos registrados hay
else $idPartido = 1;

$sql = "SELECT * FROM equipos ORDER BY puntos DESC LIMIT 3";
$consulta = $conn->query($sql);
$ganadores = mysqli_fetch_all($consulta);

$empate = 0;
if($idPartido > 15){
  if($ganadores[0][8] == $ganadores[1][8]) $empate = 1; // Verificando que haya empate teniendo en cuenta los puntos
}

$sql = "SELECT * FROM jugadores WHERE goles>=1 ORDER BY goles DESC LIMIT 10";
$consulta = $conn->query($sql);
$goleadores = mysqli_fetch_all($consulta);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/fechas.css"/>
    <title>Torneo</title>
</head>
<body class="bg-dark">
    <div class="accordion accordion-flush mx-auto container-sm rounded mt-5" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              Fecha 1
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=1&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[1][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 1 ? "disabled" : "" ?>">Jugar</a>
                    </div>
                </div>
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=2&E1=<?= $equipos[2][0] ?>&E2=<?= $equipos[3][0] ?>"
                            class="btn btn-primary <?php echo $idPartido != 2 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=3&E1=<?= $equipos[4][0] ?>&E2=<?= $equipos[5][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 3 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              Fecha 2
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=4&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[5][0] ?>"
                            class="btn btn-primary <?php echo $idPartido != 4 ? "disabled" : "" ?>">Jugar</a>
                    </div>
                </div>
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=5&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[2][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 5 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=6&E1=<?= $equipos[3][0] ?>&E2=<?= $equipos[4][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 6 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
              Fecha 3
            </button>
          </h2>
          <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=7&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[2][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 7 ? "disabled" : "" ?>">Jugar</a>
                    </div>
                </div>
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=8&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[4][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 8 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=9&E1=<?= $equipos[3][0] ?>&E2=<?= $equipos[5][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 9 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
              Fecha 4
            </button>
          </h2>
          <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=10&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[3][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 10 ? "disabled" : "" ?>">Jugar</a>
                    </div>
                </div>
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=11&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[5][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 11 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
               <div class="teamContainer position-relative h3 container">
                    <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
                    <h3>VS</h3>
                    <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
                    <div class="mx-auto me-1 float-end">
                        <a href="jugarFecha.php?id=12&E1=<?= $equipos[2][0] ?>&E2=<?= $equipos[4][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 12 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
              Fecha 5
            </button>
          </h2>
          <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                 <div class="teamContainer position-relative h3 container">
                      <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
                      <h3>VS</h3>
                      <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
                      <div class="mx-auto me-1 float-end">
                          <a href="jugarFecha.php?id=13&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[3][0] ?>" 
                              class="btn btn-primary <?php echo $idPartido != 13 ? "disabled" : "" ?>">Jugar</a>
                      </div>
                  </div>
                 <div class="teamContainer position-relative h3 container">
                      <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
                      <h3>VS</h3>
                      <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
                      <div class="mx-auto me-1 float-end">
                          <a href="jugarFecha.php?id=14&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[4][0] ?>" 
                              class="btn btn-primary <?php echo $idPartido != 14 ? "disabled" : "" ?>">Jugar</a>
                      </div>
                 </div>
                 <div class="teamContainer position-relative h3 container">
                      <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
                      <h3>VS</h3>
                      <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
                      <div class="mx-auto me-1 float-end">
                          <a href="jugarFecha.php?id=15&E1=<?= $equipos[2][0] ?>&E2=<?= $equipos[5][0] ?>" 
                              class="btn btn-primary <?php echo $idPartido != 15 ? "disabled" : "" ?>">Jugar</a>
                      </div>
                 </div>
              </div>
            </div>
        </div>
        <div class="cardContainer container row justify-content-around mt-2 mx-auto">
          <?php foreach($equipos as $equipo): ?>
            <div class="card mx-auto mt-3 col-12 d-flex">
              <div class="card-body">
                <h5 class="card-title"><?= $equipo[1] ?></h5>
                <h6 class="card-subtitle mb-2 text-success"><?= $equipo[8] ?> Puntos en el torneo</h6>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. In est aspernatur, consequuntur optio nam reprehenderit.</p>
                <a href="verEquipo.php?id=<?= $equipo[0] ?>" class="card-link">Ver equipo</a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="text-light p-3 mt-2 container">
          <h3>Top 3 equipos</h3>
          <table class="table table-dark table-striped">
            <thead>
              <tr class="table-primary">
                <th scope="col">Puesto</th>
                <th scope="col">Equipo</th>
                <th scope="col">Puntos</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($ganadores as $i => $ganador): ?>
              <tr>
                <th scope="row"><?= $i+1 ?>??</th>
                <td scope="row"><?= $ganador[1] ?></td>
                <td scope="row"><?= $ganador[8] ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
        <?php if($empate): ?>
          <div class="container card text-dark p-0 row d-flex text-center mx-auto div-empate col-sm-6">
            <h3 class="mt-2 text-danger col-12">Empate</h3>
            <div class="d-flex position-relative row mx-auto">
              <a href="verEquipo.php?id=<?= $ganadores[0][0] ?>" class="col-12 p-0"><?= $ganadores[0][1] ?></a>
              <p class="mx-auto mt-1 mb-1 p-0">VS</p>
              <a href="verEquipo.php?id=<?= $ganadores[1][0] ?>" class="col-12 p-0"><?= $ganadores[1][1] ?></a>
              <div class="d-flex mx-auto col-12 div-btn-empate">
                <a href="jugarFecha.php?id=16&E1=<?= $ganadores[0][0] ?>&E2=<?= $ganadores[1][0] ?>"
                class="btn btn-primary d-flex mx-auto">Desempatar</a>
              </div>
            </div>
          </div>
        <?php endif ?>
          <h3 class="mt-3 mb-3">Top 10 goleadores</h3>
          <div class="d-flex container p-0 div-tabla-jugadores">
            <table class="table table-striped table-dark tabla-jugadores">
              <thead>
                <tr class="table-primary">
                  <th scope="col">Puesto</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Goles</th>
                  <th scope="col">Puesto</th>
                  <th scope="col">Equipo</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($goleadores as $i => $jugador): ?>
                <tr>
                  <th scope="row"><?= $i+1 ?>??</th>
                  <td scope="row"><?= $jugador[1] . " " . $jugador[2] ?></td>
                  <td scope="row"><?= $jugador[9] ?></td>
                  <td scope="row"><?= ucwords($jugador[5]) ?></td>
                  <?php foreach($equipos as $x => $equipo):
                    if($equipo[0] == $jugador[8]): ?>
                    <td scope="row"><?= $equipo[1] ?></td>
                  <?php
                    endif;
                    endforeach; 
                  ?>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <a href="tools/cerrarSesion.php" class="btn btn-light mx-auto d-flex float-end me-2 mt-2 mb-5">Cerrar Sesion</a>
    </div>
</body>
</html>