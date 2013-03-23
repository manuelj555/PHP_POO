<?php

require 'autoload.php';

function irAlTrabajo(Conductor $cond)
{
    imp("");
    if (!$cond->getVehiculo() instanceof Vehiculo) {
        imp("El conductor {$cond->getNombres()} No tiene un vehiculo en estos momentos");
        return;
    }

    if (!$cond->puedeConducir()) {
        imp("El conductor {$cond->getNombres()} No tiene permitido conducir aun");
        return;
    }

    $cond->getVehiculo()->avanzar(); //comenzamos a avanzar hasta el trabajo
    imp("El conductor {$cond->getNombres()} comienza a avanzar hasta el trabajo");
    imp("se dirige a una velocidad de {$cond->getVehiculo()->getVelocidad()} Km/Hora");
    $tipoVehiculo = get_class($cond->getVehiculo());
    imp("Va en un/una: {$tipoVehiculo}");
    $cond->getVehiculo()->detener();
    imp("El conductor {$cond->getNombres()} ha llegado al trabajo");
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