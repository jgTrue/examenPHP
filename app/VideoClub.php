<?php

namespace app;

include_once "autoload.php";
use app\Juego;
use app\Disco;
use app\CintaVideo;
use app\Cliente;
use util\ClienteNoEncontradoException;
use util\CupoSuperadoException;
use util\SoporteYaAlquiladoException;

class VideoClub
{
    private $numProductos = 0;
    private $numSocios = 0;


    public function __construct(
        private $nombre,
        private $productos = [],
        private $socios = [],

    ) {
    }

    private function incluirProducto(Soporte $producto)
    {
        array_push($this->productos, $producto);
    }

    public function incluirCintaVideo($titulo, $precio, $duracion)
    {
        $CintaVideo = new CintaVideo($titulo, $this->numProductos, $precio, $duracion);
        $this->incluirProducto($CintaVideo);
        echo "<br>Cinta de video incluido con éxito<br>";
        $this->numProductos++;
    }

    public function incluirDvd($titulo, $precio, $idiomas, $formatPantalla)
    {
        $Disco = new Disco($titulo, $this->numProductos, $precio, $idiomas, $formatPantalla);
        $this->incluirProducto($Disco);
        echo "<br>Dvd incluido con éxito<br>";
        $this->numProductos++;
    }

    public function incluirJuego($titulo, $precio, $consola, $minJ, $maxJ)
    {
        $Juego = new Juego($titulo, $this->numProductos, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($Juego);
        echo "<br>Juego incluido con éxito<br>";
        $this->numProductos++;
    }

    public function incluirSocio($nombre, $maxAlquilerConcurrente = 3)
    {
        $socio = new Cliente($nombre, $this->numSocios, $maxAlquilerConcurrente);
        array_push($this->socios, $socio);
        echo "<br>Socio incluido con éxito<br>";
        $this->numSocios++;
    }

    public function listarProductos(){
        echo "<br>Listado de productos:<br>";
        foreach ($this->productos as $value) {
            echo $value->muestraResumen();
        }
    }

    public function listarSocios()
    {
        echo "<br>Listado de socios:<br>";
        foreach ($this->socios as $value) {
            echo $value->muestraResumen();
        }
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
                            }
                        }
                    } catch (CupoSuperadoException $mCupo) {
                        echo $mCupo->messageException();
                    }catch (SoporteYaAlquiladoException $mSopo){
                        echo $mSopo->messageException();
                    } 
                }
            }
        } catch (ClienteNoEncontradoException $noClient) {
            echo $noClient->messageException();
        }
        return $this;
    }
}
