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
        protected $cumpleaños;
        private $edad;

        public function setNombres($nombres){ $this->nombres = ucwords($nombres); }
        public function getNombres(){ return $this->nombres; }
        public function setCumpleaños(DateTime $fecha)
        { 
            $this->cumpleaños = $fecha->format('d-m-Y');
            $this->edad = $fecha->diff(new DateTime('now'))->y; //obtenemos el numero de años entre el cumpleaños y hoy
        }
        public function getCumpleaños(){ return $this->cumpleaños; }
        public function getEdad(){ return $this->edad; }
    }

En el ejemplo anterior hemos creado una clase Persona con tres atributos: nombres, cumpleaños y edad, los dos primeros son protegidos, mientras que el ultimo es privado, esto lo hacemos así debido a que no queremos permitir que el atributo edad puede ser modificado ni desde fuera de la clase ni desde clases que hereden de Persona.

`Fuente <http://www.phpya.com.ar/poo/temarios/descripcion.php?cod=45&punto=11&inicio=0>`_
