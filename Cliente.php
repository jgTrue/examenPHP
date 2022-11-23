<?php
include_once 'Soporte.php';
class Cliente
{

    private $soportesAlquilados = [];
    private $numSoportesAlquilados = 0;

    public function __construct(
        public $nombre,
        private $numero,
        private $maxAlquilerConcurrente = 3
    ) {
    }




    // Get the value of numero 
    public function getNumero()
    {
        return $this->numero;
    }


    // Set the value of numero
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }


    // Get the value of soportesAlquilados
    public function getSoportesAlquilados()
    {
        return $this->soportesAlquilados;
    }

    public function alquilar(Soporte $s): bool
    {
        if ($this->tieneAlquilado($s) == false) {
            if ($this->numSoportesAlquilados < $this->maxAlquilerConcurrente) {
                array_push($this->soportesAlquilados, $s);
                $this->numSoportesAlquilados++;
                echo "<br>El alquiler de '" . $s->titulo . "' se realizó con éxito.<br>";
                return true;
            } else {
                echo "<br>Ha realizado el número máximo de alquileres, " . $this->maxAlquilerConcurrente . ".<br>";
                return false;
            }
        } else {
            echo "<br>Ya tiene alquilado " . $s->titulo . ".<br>";
            return false;
        }
    }

    public function tieneAlquilado(Soporte $s): bool
    {
        return (in_array($s, $this->soportesAlquilados));
    }

    public function devolver(int $numSoporte): bool
    {

        foreach ($this->soportesAlquilados as $key => $value) {
            if ($value->getNumero() == $numSoporte) {
                unset($this->soportesAlquilados[$key]);
                $this->numSoportesAlquilados--;
                echo "<br>La devolución de " . $value->titulo . " se ha realizado con éxito.<br>";
                return true;
            }
        }
        echo "<br>El soporte " . $numSoporte . " no está entre sus alquileres.<br>";
        return false;
    }

    public function listaAlquileres(): void
    {

        if (empty($this->soportesAlquilados)) {
            echo "<br>Actualmente no posee productos alquilados.<br>";
        } else {
            echo "<br>Alquilado: " . $this->numSoportesAlquilados . ".<br>Lista:<br>";
            foreach ($this->soportesAlquilados as $value) {
                echo $value->muestraResumen();
            }
        }
    }

    public function muestraResumen()
    {
        echo "<br><strong>Cliente Número: " . $this->numero . "</strong><br>";
        echo "<br>Nombre: " . $this->nombre . "<br>";
        $this->listaAlquileres();
    }
}

?>