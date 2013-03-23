<?php

require_once 'autoload.php';

//usando la clase Persona

$cliente = new Persona();

$cliente->setNombres("manuel aguirre")
        ->setCumpleanos(new DateTime('08-11-1988'));

imp($cliente->getNombres()); //imprime Manuel Aguirre
imp($cliente->getCumpleanosString()); // imprime 08-11-1988
imp($cliente->getEdad()); // imprime 24
imp("Nació el ". $cliente->getCumpleanos()->format('d \d\e\l \m\e\s m \d\e Y') . '<br/><br/>'); 
// imprime Nació el 08 del mes 11 de 1988

//usando la clase Vendedor

$vendedor = new Vendedor();

$vendedor->setNombres("pedro perez")
        ->setCumpleanos(new DateTime('10-10-1990'));

$vendedor->setFechaIngreso(new DateTime('05-12-2010'));
$vendedor->setTurno(new DateTime('08:00'), new DateTime('17:00'));

imp($vendedor->getNombres()); //imprime Pedro Perez
imp($vendedor->getCumpleanosString()); //imprime 10-10-1990
imp($vendedor->getEdad()); //imprime 22
imp($vendedor->getFechaIngreso()->format('d / m / Y')); //imprime 05 / 12 / 2010
list($comienzo, $termino) = $vendedor->getTurno();
imp("Trabaja desde las {$comienzo->format('H:i')} Horas, hasta las {$termino->format('H:i')} Horas"); 
//imprime Trabaja desde las 08:00 Horas, hasta las 17:00 Horas
imp($vendedor->getHorasDiarias()); //imprime 9


        