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
        protected $nombre;
        protected $cumpleaños;
        private $edad;

        public function setNombre($nombre){ $this->nombre = $nombre; }
        public function getNombre(){ return $this->nombre; }
    }

`Fuente <http://www.phpya.com.ar/poo/temarios/descripcion.php?cod=45&punto=11&inicio=0>`_
