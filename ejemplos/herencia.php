<?php

require_once 'autoload.php';

$cliente = new Persona();

$cliente->setNombres("manuel aguirre")
        ->setCumpleanos(new DateTime('08-11-1988'));

imp($cliente->getNombres());
imp($cliente->getCumpleanosString());
imp($cliente->getEdad());
imp("Nació el ". $cliente->getCumpleanos()->format('d \d\e\l \m\e\s m \d\e Y') . '<br/><br/>');

$vendedor = new Vendedor();

$vendedor->setNombres("pedro perez")
        ->setCumpleanos(new DateTime('10-10-1990'));

$vendedor->setFechaIngreso(new DateTime('05-12-2010'));
$vendedor->setTurno(new DateTime('08:00'), new DateTime('17:00'));

imp($vendedor->getNombres());
imp($vendedor->getCumpleanosString());
imp($vendedor->getEdad());
imp($vendedor->getFechaIngreso()->format('d / m / Y'));
list($comienzo, $termino) = $vendedor->getTurno();
imp("Trabaja desde las {$comienzo->format('H:i')} Horas, hasta las {$termino->format('H:i')} Horas");
imp($vendedor->getHorasDiarias());


        