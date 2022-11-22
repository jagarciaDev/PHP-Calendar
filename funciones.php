<?php
function verificarFestivo($dia, $mes)
{

    $esFestivo = false;
    $fecha = "$dia-$mes";

    switch ($fecha) { //CONTROLAMOS LOS FESTIVOS PARA COLOR ROJO
        case '12-octubre':
        case '31-octubre':
        case '1-noviembre':
        case '5-diciembre':
        case '6-diciembre':
        case '7-diciembre':
        case '8-diciembre':
        case '23-diciembre':
        case '24-diciembre':
        case '25-diciembre':
        case '26-diciembre':
        case '27-diciembre':
        case '28-diciembre':
        case '29-diciembre':
        case '30-diciembre':
        case '31-diciembre':
        case '1-enero':
        case '2-enero':
        case '3-enero':
        case '4-enero':
        case '5-enero':
        case '6-enero':
        case '7-enero':
        case '8-enero':
        case '24-febrero':
        case '27-febrero':
        case '20-marzo':
        case '31-marzo':
        case '2-abril':
        case '3-abril':
        case '4-abril':
        case '5-abril':
        case '6-abril':
        case '7-abril':
        case '8-abril':
        case '9-abril':
        case '10-abril':
        case '1-mayo':
        case '2-mayo':
            $esFestivo = true;
            break;
    }
    return $esFestivo;
}

function verificarInicioyFin($dia, $mes)
{

    $esInicio = false;
    $fecha = "$dia-$mes";

    switch ($fecha) { //CONTROLAMOS EL INICIO Y FINAL DEL CURSO PARA COLOR VERDE
        case '7-septiembre':
        case '22-junio':
            $esInicio = true;
            break;
    }
    return $esInicio;
}

function yearBisiesto($year) //COMPROBAR QUE EL AÑO SEA BISIESTO
{
    if (($year % 4) == 0) {
        if (($year % 100) == 0) {
            if (($year % 400) == 0) {
                return 29;
            } else {
                return 28;
            }
        } else {
            return 29;
        }
    } else {
        return 28;
    }
}
