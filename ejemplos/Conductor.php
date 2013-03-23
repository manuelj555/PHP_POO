<?php

/**
 * Description of Conductor
 *
 * @author manuel
 */
class Conductor extends Persona
{

    /**
     *
     * @var Vehiculo
     */
    protected $vehiculo;
    protected $puedeConducir = false;

    public function getVehiculo()
    {
        return $this->vehiculo;
    }

    public function setVehiculo(Vehiculo $vehiculo)
    {
        $this->vehiculo = $vehiculo;
        if ($this->cumpleanos) {
            $this->setPuedeConducir($this->getEdad() >= $this->vehiculo->edadMinima());
        }
    }

    public function setCumpleanos(DateTime $cumpleanos)
    {
        parent::setCumpleanos($cumpleanos);
        if ($this->vehiculo) {
            $this->setPuedeConducir($this->getEdad() >= $this->vehiculo->edadMinima());
        }
        return $this;
    }

    public function puedeConducir()
    {
        return $this->puedeConducir;
    }

    protected function setPuedeConducir($puedeConducir)
    {
        $this->puedeConducir = $puedeConducir;
    }

}
