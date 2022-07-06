<?php

include_once 'ejercicio3_functions.php';

echo "<H1> TEST convertirHoraAMinutos </H1>";
echo "<H3> esperado 630 </H3>";
var_dump(convertirHoraAMinutos('10:30'));
echo "<H3> esperado 690 </H3>";
var_dump(convertirHoraAMinutos('11:30'));
echo "<H3> esperado false </H3>";
var_dump(convertirHoraAMinutos('10:60'));
echo "<H3> esperado false </H3>";
var_dump(convertirHoraAMinutos('24:30'));

echo "<H1> TEST convertirHoraAMinutos </H1>";
echo "<H3> esperado [630,690] </H3>";
         
var_dump(convertirTramoHorasATramoMinutos('10:30-11:30'));

echo "<H1> TEST esTramoHorasContenidoEnOtroTramoHoras  </H1>";
echo "<H3> esperado false </H3>";
var_dump(esTramoHorasContenidoEnOtroTramoHoras('10:30-11:30','10:31-11:29'));
echo "<H3> esperado false </H3>";
var_dump(esTramoHorasContenidoEnOtroTramoHoras('10:30-11:30','10:29-11:29'));
echo "<H3> esperado false </H3>";
var_dump(esTramoHorasContenidoEnOtroTramoHoras('10:30-11:30','10:31-11:31'));
echo "<H3> esperado false </H3>";
var_dump(esTramoHorasContenidoEnOtroTramoHoras('10:31-11:29','10:32-11:31'));
echo "<H3> esperado false </H3>";
var_dump(esTramoHorasContenidoEnOtroTramoHoras('10:31-11:29','10:30-11:15'));
echo "<H3> esperado false </H3>";
var_dump(esTramoHorasContenidoEnOtroTramoHoras('09:30-10:29','10:30-11:15'));
echo "<H3> esperado false </H3>";
var_dump(esTramoHorasContenidoEnOtroTramoHoras('10:30-11:15','09:30-10:29'));
echo "<H3> esperado true </H3>";
var_dump(esTramoHorasContenidoEnOtroTramoHoras('10:30-11:30','10:29-11:31'));

echo "<H1> TEST comprobarSiSePisanTramosHoras   </H1>";
echo "<H3> esperado 'se pisan' </H3>";
var_dump(comprobarSiSePisanTramosHoras('10:30-11:30','11:15-12:15'));
echo "<H3> esperado 'se pisan' </H3>";
var_dump(comprobarSiSePisanTramosHoras('11:15-12:15','10:30-11:30'));
echo "<H3> esperado 'se pisan' </H3>";
var_dump(comprobarSiSePisanTramosHoras('10:45-11:15','10:30-11:30'));
echo "<H3> esperado 'se pisan' </H3>";
var_dump(comprobarSiSePisanTramosHoras('10:30-11:30','10:45-11:15'));
echo "<H3> esperado 'no se pisan' </H3>";
var_dump(comprobarSiSePisanTramosHoras('10:30-11:29','11:30-11:45'));
echo "<H3> esperado 'no se pisan' </H3>";
var_dump(comprobarSiSePisanTramosHoras('11:30-11:45','10:30-11:29'));

echo "<H1> TEST comporbarTramoHoras </H1>";
echo "<H3> esperado false </H3>";
var_dump(comprobarTramoHoras('10:00-:30')); //Salida esperada: false
echo "<H3> esperado false </H3>";
var_dump(comprobarTramoHoras('10:00-10')); //Salida esperada: false
echo "<H3> esperado false </H3>";
var_dump(comprobarTramoHoras('10:00-10:60')); //Salida esperada: false
echo "<H3> esperado false </H3>";
var_dump(comprobarTramoHoras('10:00-24:59')); //Salida esperada: false
echo "<H3> esperado true </H3>";
var_dump(comprobarTramoHoras('10:00-10:30')); //Salida esperada: true

echo "<H1> TEST comprobarSiPisaTramosOcupados </H1>";
$ocupaciontest = ['11:30-12:30', '12:31-13:30', '16:30-18:00', '18:20-18:40'];
echo "<H3> esperado array vacío</H3>";
var_dump(comprobarSiPisaTramosOcupados("10:00-10:30",$ocupaciontest)); // Salida esperada: array vacío.
echo "<H3> esperado array 1 coincidencia</H3>";
var_dump(comprobarSiPisaTramosOcupados("10:20-11:30",$ocupaciontest)); // Salida esperada: array con 1 coincidencia.
echo "<H3> esperado array 1 coincidencia</H3>";
var_dump(comprobarSiPisaTramosOcupados("11:31-11:32",$ocupaciontest)); // Salida esperada: array con 1 coincidencia
echo "<H3> esperado array 1 coincidencia</H3>";
var_dump(comprobarSiPisaTramosOcupados("10:30-12:30",$ocupaciontest)); // Salida esperada: array con 1 coincidencia
echo "<H3> esperado array 2 coincidencias</H3>";
var_dump(comprobarSiPisaTramosOcupados("10:30-13:30",$ocupaciontest)); // Salida esperada: array con 2 coincidencias
echo "<H3> esperado array 1 coincidencia</H3>";
var_dump(comprobarSiPisaTramosOcupados("18:10-18:50",$ocupaciontest)); // Salida esperada: array con 1 coincidencia

echo "<H1> TEST comprobarSiPisaTramosOcupados </H1>";
$horariotest = ['10:00-13:30', '16:30-20:30'];
echo "<H3> esperado false</H3>";
var_dump(comprobarSiEntraEnHorario("10:00-13:31",$horariotest)); //Salida esperada: false
echo "<H3> esperado true</H3>";
var_dump(comprobarSiEntraEnHorario("10:00-13:30",$horariotest)); //Salida esperada: true
echo "<H3> esperado false</H3>";
var_dump(comprobarSiEntraEnHorario("9:59-12:30",$horariotest)); //Salida esperada: false
echo "<H3> esperado true</H3>";
var_dump(comprobarSiEntraEnHorario("16:30-20:30",$horariotest)); //Salida esperada: true
echo "<H3> esperado false</H3>";
var_dump(comprobarSiEntraEnHorario("16:30-20:31",$horariotest)); //Salida esperada: false
