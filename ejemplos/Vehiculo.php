<?php

/**
 *
 * @author manuel
 */
interface Vehiculo
{

    public function avanzar();

    public function detener();
    
    public function enMovimiento();
    
    public function getVelocidad();
    
    public function edadMinima();
}