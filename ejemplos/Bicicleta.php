<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bicicleta
 *
 * @author manuel
 */
class Bicicleta implements Vehiculo
{

    protected $vel;

    public function avanzar()
    {
        $this->vel = 20;
    }

    public function detener()
    {
        $this->vel = 0;
    }

    public function edadMinima()
    {
        return 10;
    }

    public function enMovimiento()
    {
        return $this->vel > 0;
    }

    public function getVelocidad()
    {
        return $this->vel;
    }

}

