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


if(count($partidos) > 0) count($partidos); //Cuenta cuantos partidos registrados hay
else $idPartido = 1;



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Torneo</title>
</head>
<body class="bg-dark">
    <a href="tools/cerrarSesion.php" class="text-white">Cerrar Sesion</a>

    <div class="accordion accordion-flush mx-auto w-50 rounded mt-5" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              Fecha 1
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
                    <div>
                        <a href="jugarFecha.php?id=1&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[1][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 1 ? "disabled" : "" ?>">Jugar</a>
                    </div>
                </div>
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
                    <div>
                        <a href="jugarFecha.php?id=2&E1=<?= $equipos[2][0] ?>&E2=<?= $equipos[3][0] ?>"
                            class="btn btn-primary <?php echo $idPartido != 2 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
                    <div>
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
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
                    <div>
                        <a href="jugarFecha.php?id=4&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[5][0] ?>"
                            class="btn btn-primary <?php echo $idPartido != 4 ? "disabled" : "" ?>">Jugar</a>
                    </div>
                </div>
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
                    <div>
                        <a href="jugarFecha.php?id=5&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[2][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 5 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
                    <div>
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
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
                    <div>
                        <a href="jugarFecha.php?id=7&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[2][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 7 ? "disabled" : "" ?>">Jugar</a>
                    </div>
                </div>
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
                    <div>
                        <a href="jugarFecha.php?id=8&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[4][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 8 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
                    <div>
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
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
                    <div>
                        <a href="jugarFecha.php?id=10&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[3][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 10 ? "disabled" : "" ?>">Jugar</a>
                    </div>
                </div>
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
                    <div>
                        <a href="jugarFecha.php?id=11&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[5][0] ?>" 
                            class="btn btn-primary <?php echo $idPartido != 11 ? "disabled" : "" ?>">Jugar</a>
                    </div>
               </div>
               <div class="teamContainer">
                    <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
                    VS
                    <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
                    <div>
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
                 <div class="teamContainer">
                      <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
                      VS
                      <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
                      <div>
                          <a href="jugarFecha.php?id=13&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[3][0] ?>" 
                              class="btn btn-primary <?php echo $idPartido != 13 ? "disabled" : "" ?>">Jugar</a>
                      </div>
                  </div>
                 <div class="teamContainer">
                      <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
                      VS
                      <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
                      <div>
                          <a href="jugarFecha.php?id=14&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[4][0] ?>" 
                              class="btn btn-primary <?php echo $idPartido != 14 ? "disabled" : "" ?>">Jugar</a>
                      </div>
                 </div>
                 <div class="teamContainer">
                      <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
                      VS
                      <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
                      <div>
                          <a href="jugarFecha.php?id=15&E1=<?= $equipos[2][0] ?>&E2=<?= $equipos[5][0] ?>" 
                              class="btn btn-primary <?php echo $idPartido != 15 ? "disabled" : "" ?>">Jugar</a>
                      </div>
                 </div>
              </div>
            </div>
        </div>
    </div>

    <a href="verEstadisticas.php">Ver estadisticas del torneo</a>
    <p style="color:#fff">Poner tarjetas de bootstrap para los equipos</p>
</body>
</html>