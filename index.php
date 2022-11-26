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

    <title>Videoclub index</title>

    <?php
    if ($_GET) {
        $err = $_GET['err'];
    }
    ?>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 my-2" href="#"><i class="bi bi-fast-forward-btn mx-3 fs-2 text-danger"></i>Videoclub</a>
        </div>
    </nav>

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center font-monospace">

                    <i class="bi bi-person-circle fs-1 text-danger"></i>
                    <h3 class="mb-3">Iniciar sesión</h3>
                    <hr class="my-2">
                    <form action="./login.php" method="POST">
                        <div class="form-outline mb-4 text-start">
                        <label class="form-label fw-bold" for="usuarioName">Usuario</label>
                        <input type="text" id="usuarioName" name="usuarioName" class="form-control form-control-lg <?php if(isset($err)) echo "border-danger" ?>" required/>
                        </div>

                        <div class="form-outline mb-4 text-start">
                        <label class="form-label fw-bold" for="usuarioPass">Password</label>
                        <input type="password" id="usuarioPass" name="usuarioPass" class="form-control form-control-lg <?php if(isset($err)) echo "border-danger" ?>" required/>
                        </div>
                        <?php if(isset($err)) { ?>
        
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong >Usuario o contraseña incorrecto.</strong>
                                <button type="button" class="close bg-transparent border-0 mx-3" data-dismiss="alert" aria-label="Close">
                                    <i class="bi bi-exclamation-octagon"></i>
                                </button>
                            </div>
                            
                        <?php } ?>
                        <button class="btn btn-primary btn-lg btn-block bg-danger border-dark" type="submit">Iniciar</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    
</body>
</html>