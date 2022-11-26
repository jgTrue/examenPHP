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
        session_start();
        $usuarioName = $_SESSION['user'] ?? ''; // asigna el nombre del usuario
         //asigna el array del usuario
        
        if($usuarioName === 'admin'){ //Comprueba que sea el usuario logado tenga permiso permiso y muestra el contenido
    ?>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 my-2" href="./mainCliente.php"><i class="bi bi-fast-forward-btn mx-3 fs-2 text-danger"></i>Videoclub</a>
            <a class="btn btn-lg btn-primary bg-danger border border-dark" href="./logout.php" role="button">Logout<i class="bi bi-door-closed-fill mx-1"></i></a>
        </div>
    </nav>

    <main class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>Bienvenido de nuevo, <strong><?=$usuarioName?></strong>. Esta es la página de administración de videoclub.</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </main>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h3 class="display-8 fw-bold">Lista productos</h3>
        <table class="table table-dark table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h3 class="display-8 fw-bold">Lista clientes</h3>
        <table class="table table-dark table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>

    

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