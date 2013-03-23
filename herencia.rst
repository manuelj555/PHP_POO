Herencia en PHP
=======

La herencia significa que se pueden crear nuevas clases partiendo de clases existentes, que tendrán todas los atributos y los métodos de su 'superclase' o 'clase padre' y además se le podrán añadir otros atributos y métodos propios.

En PHP, a diferencia de otros lenguajes orientados a objetos (C++), una clase sólo puede derivar de una única clase, es decir, PHP no permite herencia múltiple.

Superclase o clase padre
----------

Clase de la que desciende o deriva una clase. Las clases hijas (descendientes) heredan (incorporan) automáticamente los atributos y métodos de la la clase padre (publicos y protegidos).

Subclase
----------

Clase desciendiente de otra. Hereda automáticamente los atributos y métodos (publicos y protegidos) de su superclase. Es una especialización de otra clase. Admiten la definición de nuevos atributos y métodos para aumentar la especialización de la clase.

Ejemplo:
_______

.. code-block:: php

    <?php

    class Persona
    {
        protected $nombres;
        protected $cumpleanos;
        private $edad;

        public function setNombres($nombres){ $this->nombres = ucwords($nombres); }
        public function getNombres(){ return $this->nombres; }
        public function setCumpleanos(DateTime $fecha)
        { 
            $this->cumpleanos = $fecha->format('d-m-Y');
            $this->edad = $fecha->diff(new DateTime('now'))->y; //obtenemos el numero de años entre el cumpleaños y hoy
        }
        public function getCumpleanos(){ return $this->cumpleanos; }
        public function getEdad(){ return $this->edad; }
    }

En el ejemplo anterior hemos creado una clase Persona con tres atributos: nombres, cumpleaños y edad, los dos primeros son protegidos, mientras que el ultimo es privado, esto lo hacemos así debido a que no queremos permitir que el atributo edad pueda ser modificado ni desde fuera de la clase ni desde clases que hereden de Persona.

Extendiendo la clase Persona
......

.. code-block:: php

    <?php

    class Vendedor extends Persona //usamos la palabra clave extends seguida de la clase que queremos heredar
    {
        /* con esto nuestra clase vendedor posee los métodos publicos y protegidos de la clase Persona,
           lo mismo pasa con sus atributos */

        protected $fechaIngreso;
        protected $turno;
        protected $horasDiarias;

        public function setFechaIngreso(DateTime $fecha)
        {
            $this->fechaIngreso = $fecha->format('d-m-Y');
        }

        public function getFechaIngreso(){ return $this->fechaIngreso; }
        public function setTurno(DateTime $inicio, DateTime $fin)
        { 
            $this->turno = array(
                'inicio' => $inicio->format("H:i:s"),
                'fin' => $fin->format("H:i:s"),
            ); 
            $this->horasDiarias = $fin->diff($inicio)->h;
        }
        public function getTurno(){ return $this->turno; }
        public function getHorasDiarias(){ return $this->horasDiarias; }
    }

Hemos extendido la clase Persona en la clase Vendedor, por lo tanto podemos acceder a los métodos y atributos publicos de la clase persona en cualquier instancia de la clase Vendedor, y a cualquier método y atributo protegido desde dentro de la clase Vendedor, sin embargo, no podemos acceder a los métodos y atributos privados ni desde fuera ni desde dentro de las clases que deriven de Persona. Veamos un ejemplo de uso de la clase Persona y Vendedor:

.. code-block:: php

    <?php

    $cliente = new Persona();

    $cliente->setNombres("manuel aguirre");
    $cliente->setCumpleanos(new DateTime('08-11-1988'));

    echo $cliente->getNombres(); //imprime Manuel Aguirre
    echo $cliente->getCumpleanos(); //imprime 08-11-1988
    echo $cliente->getEdad(); //imprime 24 (Para Marzo de 2013)

    $vendedor = new Vendedor();
    $vendedor->setNombres("manuel aguirre"); //podemos acceder a los métodos publicos de la clase Padre (Persona)
    $vendedor->setCumpleanos(new DateTime('08-11-1988'));
    $vendedor->setFechaIngreso(new DateTime('10-10-2010')); //y por supuesto, a los métodos publicos de la propia clase
    $vendedor->seTurno(new DateTime('08:00'), new DateTime('17:00'));

    echo $vendedor->getNombres(); //imprime Manuel Aguirre
    echo $vendedor->getCumpleanos(); //imprime 08-11-1988
    echo $vendedor->getEdad(); //imprime 24 (Para Marzo de 2013)
    echo $vendedor->getFechaIngreso(); //imprime 10-10-2010
    list($desde, $hasta) = $vendedor->getTurno();
    echo "trabaja desde las $desde horas hasta las $hasta"; //imprime trabaja desde las 08:00 horas hasta las 17:00
    echo $vendedor->getHorasDiarias(); //imprime 8

Fuentes:
-------

    * http://www.phpya.com.ar/poo/temarios/descripcion.php?cod=45&punto=11&inicio=0 
    * http://php.net/manual/es/language.oop5.inheritance.php 
    * http://www.php.net/manual/es/class.dateinterval.php#dateinterval.props.h 
