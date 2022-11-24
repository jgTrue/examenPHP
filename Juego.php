<?php 
    include_once 'Soporte.php';

    class Juego extends Soporte{

        public function __construct(   
            $titulo,
            $numero,
            $precio,
            public $consola,
            private $minNumJugadores,
            private $maxNumJugadores
        )
        {
            Soporte::__construct($titulo,$numero,$precio);
        }

        // Get the value of minNumJugadores - maxNumJugadores
        public function muestraJugadoresPosible(){
            if($this->minNumJugadores == $this->maxNumJugadores){
                return ($this->maxNumJugadores > 1) ? "<br>Para ".$this->maxNumJugadores." jugadores." : "<br>Para un jugador.<br>";
            }else{
                return "<br>De ".$this->minNumJugadores." a ".$this->maxNumJugadores." jugadores.<br>";
            }
        }

        // Get the value of resumen
        public function muestraResumen(){
            parent::muestraResumen();
            echo "Consola: ".$this->consola;
            echo $this->muestraJugadoresPosible();   
        }

    }

?>