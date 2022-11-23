<?php 
    include_once 'Soporte.php';

    class Disco extends Soporte{

        public function __construct(   
            $titulo,
            $numero,
            $precio,
            public $idiomas,
            private $formatPantalla
        )
        {
            Soporte::__construct($titulo,$numero,$precio);
        }

        // Get the value of resumen
        public function mostraResumen(){
            Soporte::muestraResumen();
            echo "<br>Idioma: ".$this->idiomas."<br>";
            echo "<br>Formato pantalla: ".$this->formatPantalla."<br>";
        }
    }


?>