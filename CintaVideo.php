<?php 
    include_once 'Soporte.php';
    
    class CintaVideo extends Soporte{

        public function __construct(   
            $titulo,
            $numero,
            $precio,
            private $duracion
        )
        {
            Soporte::__construct($titulo,$numero,$precio);
        }

        // Get the value of resumen
        public function mostraResumen(){
            Soporte::muestraResumen();
            echo "<br>Duración: ".$this->duracion."<br>";
        }
    }
