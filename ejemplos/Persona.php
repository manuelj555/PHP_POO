<?php

/**
 * Description of Persona
 *
 * @author manuel
 */
class Persona
{

    /**
     *
     * @var string
     */
    protected $nombres;

    /**
     *
     * @var DateTime
     */
    protected $cumpleanos;

    /**
     *
     * @var int
     */
    private $edad;

    /**
     * Devuelve los nombres de la Persona
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Establece los Nombres de la Persona
     * además los capitaliza
     * @param string $nombres
     * @return self
     */
    public function setNombres($nombres)
    {
        $this->nombres = ucwords($nombres);
        return $this;
    }

    /**
     * Devuelve el objeto DateTime con la fecha de Cumpleaños
     * @return DateTime
     */
    public function getCumpleanos()
    {
        return $this->cumpleanos;
    }

    /**
     * Devuelve la fecha de cumpleaños como string
     * @param string $format
     * @return string
     */
    public function getCumpleanosString($format = 'd-m-Y')
    {
        if (!($this->cumpleanos instanceof DateTime)) {
            //si no se ha establecido la fecha de cumpleaños aun, lanzamos una excepción
            throw new LogicException("No se ha establecido aun la fecha de cumpleaños");
        }
        return $this->cumpleanos->format($format);
    }

    /**
     * Establece la fecha de cumpleaños
     * @param DateTime $cumpleanos
     * @return self
     */
    public function setCumpleanos(DateTime $cumpleanos)
    {
        $this->cumpleanos = $cumpleanos;
        $this->setEdad($cumpleanos->diff(new DateTime('now'))->y);
        return $this;
    }

    /**
     * Devuelve la edad de la persona
     * @return int
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * establece la edad de la persona
     * @param int $edad
     * @return self
     */
    private function setEdad($edad)
    {
        $this->edad = $edad;
        return $this;
    }

}
