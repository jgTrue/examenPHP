<?php 

namespace app;
require_once "autoload.php";
use app\Soporte;


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
        public function muestraResumen(){
            parent::muestraResumen();
            echo "Idioma: ".$this->idiomas."<br>";
            echo "Formato pantalla: ".$this->formatPantalla."<br>";
        }
    }


?>