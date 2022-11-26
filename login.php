<?php
    include_once 'autoload.php';
    include_once "index5.php";


    if($_POST){
        $usuarioName = $_POST['usuarioName'] ?? '';
        $usuarioPass = $_POST['usuarioPass'] ?? '';

        if($usuarioName === 'usuario' && $usuarioPass === 'usuario'){
            session_start();
            $_SESSION['user'] = $usuarioName;
            header('location:./mainCliente.php');
        }

        else if($usuarioName === 'admin' && $usuarioPass === 'admin'){
            session_start();
            $_SESSION['user'] = $usuarioName;
            $_SESSION['socios'] = $vc->getSocios();
            $_SESSION['productos'] = $vc->getProductos();
            
            header('location:./mainAdmin.php');
        }else{
            header('location:./index.php?err=login');
        }

    }
