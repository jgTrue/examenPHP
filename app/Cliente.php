<?php

namespace app;

include_once 'autoload.php';

use app\Soporte;
use util\CupoSuperadoException;
use util\SoporteNoEncontradoException;
use util\SoporteYaAlquiladoException;

class Cliente
{

    private $soportesAlquilados = [];
    private $numSoportesAlquilados = 0;



    public function __construct(
        public $nombre,
        private $numero,
        private $maxAlquilerConcurrente = 3,
        private $nombreUsuario = "",
        private $passUsuario = "",
    ) {
        if ($this->nombreUsuario == "") {
            $this->nombreUsuario = str_replace(" ", "_", $this->nombre);
        }
        if ($this->passUsuario == "") {
            $this->passUsuario = str_replace(" ", "_", $this->nombre);
        }
    }


    // Get the value of nombreUsuario
    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    //Get the value of passUsuario
    public function getPassUsuario()
    {
        return $this->passUsuario;
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

    public function alquilar(Soporte $s)
    {
        if ($this->tieneAlquilado($s) == false) {
            if ($this->numSoportesAlquilados < $this->maxAlquilerConcurrente) {
                array_push($this->soportesAlquilados, $s);
                $s->alquilado = true;
                $this->numSoportesAlquilados++;
                echo "<br>El alquiler de '" . $s->titulo . "' se realizó con éxito.<br>";
            } else {
                throw new CupoSuperadoException("<br>Ha realizado el número máximo de alquileres, " . $this->maxAlquilerConcurrente . ".<br>");
            }
        } else {
            throw new SoporteYaAlquiladoException("<br>Ya tiene alquilado " . $s->titulo . ".<br>");
        }

        return $this;
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
                $value->alquilado = false;
                // echo "<br>La devolución de " . $value->titulo . " se ha realizado con éxito.<br>";
                return true;
            }
        }
        throw new SoporteNoEncontradoException("<br>El soporte " . $numSoporte . " no está entre sus alquileres.<br>");
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
        return "<br><strong>Cliente Número: " . $this->numero . "</strong><br><br>Nombre: " . $this->nombre . "<br><br>Nombre usuario: " . $this->getNombreUsuario() . "<br>".$this->listaAlquileres();
    }
}
