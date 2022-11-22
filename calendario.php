<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario - Javi Garcia</title>

    <style>
        table {
            font-family: arial, sans-serif;
            margin-left: auto;
            margin-right: auto;
            text-align: left;
        }

        td {
            text-align: center;
            padding: 4px;
        }

        td:hover {
            background-color: #0078FF;
        }

        th {
            text-align: left;
            background-color: papayawhip;
            padding: 4px;
        }

        .festivos {
            background-color: red;
            text-decoration: underline black;
        }

        .festivos:hover {
            background-color: #DF1A1A;
        }

        .curso {
            background-color: #18AD00;
            text-decoration: underline black;
        }

        .curso:hover {
            background-color: greenyellow;
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto;
            background-color: #FFACE9;
            padding: 10px;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            padding-right: 1px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    include('funciones.php');
    $year = 2019;
    $oneSept = "domingo";
    $inicioBlanco = 0;
    $finBlanco = 0;
    $cont = 0;

    switch (true) { //CONTROLAMOS EL DIA UNO DE SEPTIEMBRE, HUECOS EN BLANCO
        case $oneSept == "lunes":
            $inicioBlanco = 0;
            break;

        case $oneSept == "martes":
            $inicioBlanco = 1;
            break;

        case $oneSept == "miercoles":
            $inicioBlanco = 2;
            break;

        case $oneSept == "jueves":
            $inicioBlanco = 3;
            break;

        case $oneSept == "viernes":
            $inicioBlanco = 4;
            break;

        case $oneSept == "sabado":
            $inicioBlanco = 5;
            break;

        case $oneSept == "domingo":
            $inicioBlanco = 6;
            break;
    }

    //ARRAY CON MESES Y DÍAS
    $meses = array(
        'septiembre' => 30,
        'octubre' => 31,
        'noviembre' => 30,
        'diciembre' => 31,
        'enero' => 31,
        'febrero' => 0, // A'0' POR QUE LE DAREMOS EL VALOR CUANDO COMPROBEMOS SI ES BISIESTO EL AÑO
        'marzo' => 31,
        'abril' => 30,
        'mayo' => 31,
        'junio' => 30
    );

    $meses['febrero'] = yearBisiesto($year); //PASAMOS POR PARAMETRO EL MES DE 'FEBRERO' PARA SABER SI ES BISIESTO

    echo "<h2 style='text-align: center'>Calendario Escolar " . $year . " - " . $year + 1 . "</h2>";
    echo "<h5 style='text-align: center'>Francisco Javier Garcia Tena - 2ºDAW</h5>";
    echo "<div class='grid-container'>";

    foreach ($meses as $clave => $valor) {
        if ($clave == 'enero') { //CUANDO LLEGUE AL MES DE 'ENERO' SUMAMOS UN AÑO
            $year++;
        }

        if ($clave == 'febrero') {
            $valor = yearBisiesto($year); //VERIFICAMOS SI EL MES DE 'FEBRER0' ES BISIESTO. LO VOLVEMOS A COMPROBRA POR QUE HEMOS SUMADO UNO AL 'YEAR'
        }

        echo "<div class='grid-item'> <table style=width: 100%;float: left; ><tr>
        <th>Lunes</th>
        <th>Martes</th>
        <th>Miercoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
        <th>Sábado</th>
        <th>Domingo</th>
        </tr> <tr>";

        if ($inicioBlanco != 7) {
            for ($cont = 0; $cont < $inicioBlanco; $cont++) {
                echo "<td> </td>";
            }
        }

        echo strtoupper($clave);

        for ($i = 1; $i <= $valor; $i++) {

            //PASAMOS $i PARA VERIFICAR SI ES FESTIVO O INICIO/FIN DE CURSO
            $respuesta = verificarFestivo($i, $clave);
            $inicioCurso = verificarInicioyFin($i, $clave);
            if ($respuesta == true) {
                $css = 'class="festivos"'; //SI ES FESTIVO PRINTAMOS EL TD CON LA CLASS DE 'FESTIVOS'
            } elseif ($inicioCurso == true) {
                $css = 'class="curso"'; //SI ES INICIO/FIN DE CURSO PRINTAMOS EL TD CON LA CLASS DE 'CURSO'
            } else {
                $css = ''; //SI NO ES NINGUNA DE LAS DOS PRINTAREMOS EL TD NORMAL
            };

            echo '<td ' . $css . '>' . $i . '</td>';
            if (($i + $cont) % 7 == 0) {

                //COLORES DE LAS COLUMNAS:
                echo "<col span=5 style='background-color: #31BCE5'>";
                echo "<col span=2 style='background-color: #FF0F0F'>";
                echo "</tr><tr>";
            }
        }

        //cont = espacias en blanco antes del mes.
        if (($valor) + $cont <= 35) { //SUMO LOS DIAS DEL MES + ESPACIOS EN BLANCO
            $numerCeldas = 35; //NÚMERO DE CASILLAS

            $h = $numerCeldas - (($valor) + $cont); //SUMO Nº DIAS + ESPACIOS EN BLANCO Y LO RESTO A LAS CASILLAS PARA CONTROLAR LOS ESPACIOS DEL FINAL Y EL EMPIECE DEL SIGUIENTE MES.

            for ($cont = 0; $cont < $h; $cont++) {
                echo "<td> </td>";
            }
        } else {
            $numerCeldas = 42; //NÚMERO DE CASILLAS

            $h = $numerCeldas - (($valor) + $cont);

            for ($cont = 0; $cont < $h; $cont++) {
                echo "<td> </td>";
            }
        }

        $inicioBlanco = 7 - $h;

        if ($inicioBlanco == 7) {
            $inicioBlanco = 0; // NO SE PUEDE IMPRIMIR UNA FILA EN BLANCO POR ESO LO PASAMOS A '0'. NO SACA NADA Y EL SIGUIENTE MES EMPIEZA '1' EN 'LUNES'.
        }


        echo "</tr></table></div>";
    }
    echo "</div>";

    ?>
</body>

</html>