<?php
include_once "Juego.php";
include_once "Disco.php";
include_once "CintaVideo.php";
include_once "Cliente.php";
class VideoClub
{
    private $numProductos = 1;
    private $numSocios = 1;


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

    public function listarProductos()
    {
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
        foreach ($this->socios as $cliente) {
            if ($cliente->getNumero()  == $numeroCliente) {
                foreach ($this->productos as $soporte) {
                    if ($soporte->getNumero() == $numeroSoporte) {
                        $cliente->alquilar($soporte);
                    }
                }
            }
        }
    }
}
