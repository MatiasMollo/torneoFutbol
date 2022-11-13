<?php
session_start();

if(isset($_SESSION['user']->id) && $_SESSION['user']->id == 1) {
    header('location:fechas.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="styles.css">
    <title>Inicio - Torneo</title>
</head>
<body class="bg-dark justify-content-center align-items-center d-flex">
    <form action="tools/validar.php" method="POST" class="container-md bg-light formulario">
        <h1>Iniciar Sesión</h1>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
      </div>
      <?php if(isset($_SESSION['message'])): ?>
            <p class="text-danger"><?php echo $_SESSION['message']->message ?></p>
            <?php endif; ?>
      <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>

</body>
</html>