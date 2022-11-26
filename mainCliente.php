<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <script defer src="./js/bootstrap.bundle.js"></script>
    <script defer src="./js/bootstrap.js"></script>
    <script defer src="./js/custom.js"></script>    

    <title>Videoclub</title>

    <?php
    if ($_GET) {
        $err = $_GET['err'];
    }
    ?>
</head>
<body>
    <?php 
        $usuarioName = $_SESSION['user'] ?? ''; // asigna el nombre del usuario
         //asigna el array del usuario
        
        if($usuarioName === 'usuario'){ //Comprueba que sea el usuario logado tenga permiso permiso y muestra el contenido
    ?>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 my-2" href="./mainCliente.php"><i class="bi bi-fast-forward-btn mx-3 fs-2 text-danger"></i>Videoclub</a>
            <a class="btn btn-lg btn-primary bg-danger border border-dark" href="./logout.php" role="button">Logout<i class="bi bi-door-closed-fill mx-1"></i></a>
        </div>
    </nav>

    <main class="container">
        <div class="bg-light p-5 rounded-3 border border-1 border-dark">
            <h1>Bienvenido de nuevo, <?=$usuarioName?></h1>
            <p class="lead">Esta es la página principal de nuestro videoclub. </p>
            <a class="btn btn-lg btn-primary bg-danger border border-dark" href="./logout.php" role="button">Cerrar sesión</a>
        </div>
    </main>

    <?php }else{ ?>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 my-2" href="./mainCliente.php"><i class="bi bi-fast-forward-btn mx-3 fs-2 text-danger"></i>Videoclub</a>
        </div>
    </nav>
    
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">No estás autorizado</h1>
            <p class="lead">Parece que estas intentado acceder al contenido sin haberte identificado.</p>
            <p>Primero debes <a href="./index.php">iniciar sesión.</a></p>
        </div>
    </main>

    <?php } ?>
</body>
</html>