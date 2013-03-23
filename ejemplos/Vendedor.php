<?php

/**
 * Description of Vendedor
 *
 * @author manuel
 */
class Vendedor extends Persona
{

    /**
     *
     * @var DateTime
     */
    protected $fechaIngreso;

    /**
     *
     * @var array
     */
    protected $turno = array(null, null);

    /**
     *
     * @var float
     */
    protected $horasDiarias;

    /**
     * 
     * @return DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * 
     * @param DateTime $fechaIngreso
     * @return \Vendedor
     */
    public function setFechaIngreso(DateTime $fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;
        return $this;
    }

    /**
     * 
     * @return array()
     */
    public function getTurno()
    {
        return $this->turno;
    }

    public function setTurno(DateTime $inicio, DateTime $fin)
    {
        $this->turno = array($inicio, $fin);
        return $this->setHorasDiarias($fin->diff($inicio)->h);
    }

    public function getHorasDiarias()
    {
        return $this->horasDiarias;
    }

    private function setHorasDiarias($horasDiarias)
    {
        $this->horasDiarias = $horasDiarias;
        return $this;
    }

}
