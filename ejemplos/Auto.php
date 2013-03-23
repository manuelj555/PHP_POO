<?php

/**
 * Description of Auto
 *
 * @author manuel
 */
class Auto implements Vehiculo
{

    protected $velocidad;

    public function avanzar()
    {
        $this->velocidad = 80;
    }

    public function detener()
    {
        $this->velocidad = 0;
    }

    public function enMovimiento()
    {
        return $this->velocidad > 0;
    }

    public function getVelocidad()
    {
        return $this->velocidad;
    }

    public function edadMinima()
    {
        return 18;
    }

}
