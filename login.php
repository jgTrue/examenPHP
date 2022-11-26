<?php
    if($_POST){
        $usuarioName = $_POST['usuarioName'] ?? '';
        $usuarioPass = $_POST['usuarioPass'] ?? '';

        if($usuarioName === 'usuario' && $usuarioPass === 'usuario'){
            session_start();
            $_SESSION['user'] = $usuarioName;
            header('location:index1.php');
        }
        else if($usuarioName === 'admin' && $usuarioPass === 'admin'){
            session_start();
            $_SESSION['user'] = $usuarioName;
            header('location:index1.php');
        }else{
            header('location:./index.php?err=login');
        }

    }
?>