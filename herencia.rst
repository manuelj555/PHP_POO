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

    $cliente->setNombres("manuel aguirre")
            ->setCumpleanos(new DateTime('08-11-1988'));

    echo($cliente->getNombres()); //imprime Manuel Aguirre
    echo($cliente->getCumpleanosString()); // imprime 08-11-1988
    echo($cliente->getEdad()); // imprime 24
    echo("Nació el ". $cliente->getCumpleanos()->format('d \d\e\l \m\e\s m \d\e Y') . '<br/><br/>'); 
    // imprime Nació el 08 del mes 11 de 1988

    $vendedor = new Vendedor();

    $vendedor->setNombres("pedro perez")
            ->setCumpleanos(new DateTime('10-10-1990'));

    $vendedor->setFechaIngreso(new DateTime('05-12-2010'));
    $vendedor->setTurno(new DateTime('08:00'), new DateTime('17:00'));

    echo($vendedor->getNombres()); //imprime Pedro Perez
    echo($vendedor->getCumpleanosString()); //imprime 10-10-1990
    echo($vendedor->getEdad()); //imprime 22
    echo($vendedor->getFechaIngreso()->format('d / m / Y')); //imprime 05 / 12 / 2010
    list($comienzo, $termino) = $vendedor->getTurno();
    echo("Trabaja desde las {$comienzo->format('H:i')} Horas, hasta las {$termino->format('H:i')} Horas"); 
    //imprime Trabaja desde las 08:00 Horas, hasta las 17:00 Horas
    echo($vendedor->getHorasDiarias()); //imprime 9

Sobreescribiendo métodos:
-----

Extendiendo métodos:
-----
Crearemos una clase que extenderá nuevamente de Persona (igual al ejemplo anterior), pero esta, reescribirá y extenderá el método setCumpleanos de la clase padre, con el fin de agregar más funcionalidad al mismo. 

.. code-block:: php

    <?php
    
    class Conductor extends Persona
    {
    
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
    
        /**
         * Volvemos a crear el método con el mismo nombres, y los mismos parametros (Es obligatorio que tenga los mismos parametros)
         *
         */
        public function setCumpleanos(DateTime $cumpleanos)
        {
            parent::setCumpleanos($cumpleanos);//llamamos al método de la clase superior usando parent::
            //ahora escribimos nuestro código adicional que queremos que se ejecute al llamar a nuestro método
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

Como ven es muy sencillo extender métodos en clases derivadas, solo debemos volver a escribirlo y agregar código dentro del mismo, entonces al llamar al método desde alguna instancia de Conductor, se ejecutará el método de la clase hija.

El código de la interfaz Vehiculo se encuentra en: https://github.com/manuelj555/PHP_POO/blob/master/ejemplos/Vehiculo.php

Ahora vemos un ejemplo de uso de la clase Conductor (Usaremos la clase Auto, para pasarla como instancia de Vehiculo al Conductor):

.. code-block:: php

    function irAlTrabajo(Conductor $cond)
    {
        if (!$cond->getVehiculo() instanceof Vehiculo) {
            echo ("El conductor {$cond->getNombres()} No tiene un vehiculo en estos momentos");
            return;
        }
    
        if (!$cond->puedeConducir()) {
            echo ("El conductor {$cond->getNombres()} No tiene permitido conducir aun");
            return;
        }
    
        $cond->getVehiculo()->avanzar(); //comenzamos a avanzar hasta el trabajo
        echo ("El conductor {$cond->getNombres()} comienza a avanzar hasta el trabajo");
        echo ("se dirige a una velocidad de {$cond->getVehiculo()->getVelocidad()} Km/Hora");
        $tipoVehiculo = get_class($cond->getVehiculo());
        echo ("Va en un/una: {$tipoVehiculo}");
        $cond->getVehiculo()->detener();
        echo ("El conductor {$cond->getNombres()} ha llegado al trabajo");
    }
    
    $coche = new Auto();
    
    $conductor1 = new Conductor();
    
    $conductor1->setNombres("MANUEL AGUIRRE");
    $conductor1->setCumpleanos(new DateTime('08-11-1988'));
    
    $conductor1->setVehiculo($coche);
    
    irAlTrabajo($conductor1);
    
    $conductor1->setVehiculo( new Bicicleta());
    
    irAlTrabajo($conductor1);
    
    $nino = new Conductor();
    
    $nino->setNombres("Pedro Perez");
    $nino->setCumpleanos(new DateTime('10-10-2002'));
    
    irAlTrabajo($nino);
    
    $nino->setVehiculo(new Auto());
    
    irAlTrabajo($nino);
    
    $nino->setVehiculo(new Bicicleta());
    
    irAlTrabajo($nino);

Fuentes:
-------

    * http://www.phpya.com.ar/poo/temarios/descripcion.php?cod=45&punto=11&inicio=0 
    * http://php.net/manual/es/language.oop5.inheritance.php 
    * http://www.php.net/manual/es/class.dateinterval.php#dateinterval.props.h 
