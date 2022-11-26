<?php

namespace app;

include_once "autoload.php";

use app\Juego;
use app\Disco;
use app\CintaVideo;
use app\Cliente;
use util\ClienteNoEncontradoException;
use util\CupoSuperadoException;
use util\SoporteNoEncontradoException;
use util\SoporteYaAlquiladoException;

class VideoClub
{
    private $numProductos = 0;
    private $numSocios = 0;

    private $numProductosAlquilados = 0;
    private $numTotalAlquileres = 0;


    public function __construct(
        private $nombre,
        private $productos = [],
        private $socios = [],

    ) {
    }


    //Get the value of productos
    public function getProductos()
    {
        return $this->productos;
    }

    //Get the value of socios
    public function getSocios()
    {
        return $this->socios;
    }


    //Get the value of numProductosAlquilados
    public function getNumProductosAlquilados()
    {
        return $this->numProductosAlquilados;
    }

    //Get the value of numTotalAlquileres
    public function getNumTotalAlquileres()
    {
        return $this->numTotalAlquileres;
    }

    private function incluirProducto(Soporte $producto)
    {
        array_push($this->productos, $producto);
    }

    public function incluirCintaVideo($titulo, $precio, $duracion)
    {
        $CintaVideo = new CintaVideo($titulo, $this->numProductos, $precio, $duracion);
        $this->incluirProducto($CintaVideo);
        // echo "<br>Cinta de video incluido con éxito<br>";
        $this->numProductos++;
    }

    public function incluirDvd($titulo, $precio, $idiomas, $formatPantalla)
    {
        $Disco = new Disco($titulo, $this->numProductos, $precio, $idiomas, $formatPantalla);
        $this->incluirProducto($Disco);
        // echo "<br>Dvd incluido con éxito<br>";
        $this->numProductos++;
    }

    public function incluirJuego($titulo, $precio, $consola, $minJ, $maxJ)
    {
        $Juego = new Juego($titulo, $this->numProductos, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($Juego);
        // echo "<br>Juego incluido con éxito<br>";
        $this->numProductos++;
    }

    public function incluirSocio($nombre, $maxAlquilerConcurrente = 3)
    {
        $socio = new Cliente($nombre, $this->numSocios, $maxAlquilerConcurrente);
        array_push($this->socios, $socio);
        // echo "<br>Socio incluido con éxito<br>";
        $this->numSocios++;
    }

    public function listarProductos()
    {
        $str = "<br>Listado de productos:<br>";
        foreach ($this->productos as $value) {
            $str .= $value->muestraResumen() ;
        }
        return $str;
    }

    public function listarSocios()
    {
        $str = "<br>Listado de socios:<br>";
        foreach ($this->socios as $value) {
            $str .= $value->muestraResumen();
        }
        return $str;
    }

    public function alquilaSocioProducto($numeroCliente, $numeroSoporte)
    {
        try {
            foreach ($this->socios as $cliente) {
                if ($cliente->getNumero()  == $numeroCliente) {
                    try {
                        foreach ($this->productos as $soporte) {
                            if ($soporte->getNumero() == $numeroSoporte) {
                                $cliente->alquilar($soporte);
                                $this->numProductosAlquilados++;
                                $this->numTotalAlquileres++;
                            }
                        }
                    } catch (CupoSuperadoException $maxCupo) {
                        return $maxCupo->messageException();
                    } catch (SoporteYaAlquiladoException $nDisponible) {
                        return $nDisponible->messageException();
                    }
                }
            }
        } catch (ClienteNoEncontradoException $noClient) {
            return $noClient->messageException();
        }
        return $this;
    }

    public function alquilarSocioProductos(int $numSocio, array $numerosProductos)
    {
        $disponible = true;
        try {
            foreach ($numerosProductos as $nSoporte) {  // Va accediendo a los soportes solicitados

                foreach ($this->productos as $soporte) { // Busca el soporte para acceder a la propiedad alquilado
                    if ($soporte->getNumero() == $nSoporte) { // Comprueba que se está accediendo al soporte deseado
                        if ($soporte->alquilado) { //Comprueba que esté disponible
                            $disponible = false; // Si alguno no está disponible será 'false'
                        }
                    }
                }
            }
            if ($disponible) { // Verifica que todos estuviesen disponibles
                foreach ($numerosProductos as $value) { // Procede a alquilarlos uno a uno
                    $this->alquilaSocioProducto($numSocio, $value);
                }
            } else {
                throw new SoporteYaAlquiladoException("<br>Existen productos que no se encuentran disponibles.<br>");
            }
        } catch (SoporteYaAlquiladoException $nDisponible) {
            return $nDisponible->messageException();
        }
        return $this;
    }

    public function devolverSocioProducto(int $numSocio, int $numeroProducto)
    {
        $socio = null;
        try {
            foreach ($this->socios as $cliente) {
                if ($cliente->getNumero()  == $numSocio) {
                    $socio = $cliente;
                    try {
                        foreach ($this->productos as $soporte) {
                            if ($soporte->getNumero() == $numeroProducto) {
                                $cliente->devolver($numeroProducto);
                                $this->numProductosAlquilados--;
                            }
                        }
                    } catch (SoporteNoEncontradoException $nExist) {
                        return $nExist->messageException();
                    }
                }
            }
            if ($socio == null) {
                throw new ClienteNoEncontradoException("<br>El cliente no consta como socio.<br>");
            }
        } catch (ClienteNoEncontradoException $noClient) {
            return $noClient->messageException();
        }
        return $this;
    }

    public function devolverSocioProductos(int $numSocio, array $numerosProductos)
    {
        $alquilado = true;
        try {
            foreach ($numerosProductos as $nSoporte) {
                foreach ($this->productos as $producto) {
                    if ($producto->getNumero() == $nSoporte) {
                        foreach ($this->socios as $socio) {

                            if ($numSocio == $socio->getNumero() && !$socio->tieneAlquilado($producto)) {
                                $alquilado = false;
                                throw new SoporteNoEncontradoException("<br>Está intentando devolver un producto que no tiene alquilado.<br>");
                            }
                        }
                    }
                }
            }
            if ($alquilado) { // Verifica que todos estuviesen alquilados
                foreach ($numerosProductos as $value) { // Procede a devolverlos uno a uno
                    $this->devolverSocioProducto($numSocio, $value);
                }
            }
        } catch (SoporteNoEncontradoException $nAlquilado) {
            return $nAlquilado->messageException();
        }
        return $this;
    }
}
