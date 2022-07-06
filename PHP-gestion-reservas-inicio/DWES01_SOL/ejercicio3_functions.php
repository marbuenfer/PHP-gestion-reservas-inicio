<?php

/**
 * Convierte la hora en formato hh:mm a minutos
 * @param $hora Hora en formato hh:mm
 * @return false si no se pudo hacer la conversión y false en caso contrario.
 */
function convertirHoraAMinutos ($hora)
{    
    list($hora,$minutos)=explode(":",$hora);
    return ($hora>=0 && $hora<24 && $minutos>=0 && $minutos<60) ? $hora*60+$minutos : false;
}

/**
 * Convierte un tramo "hh:mm-hh:mm" a tramo de minutos [m1,m2]
 * @param $tramo Tramo en formato "hh:mm-hh-mm"
 * @return array con los minutos de cada tramo
 */
function convertirTramoHorasATramoMinutos ($tramo)
{
    list($inicio,$fin)=explode('-',$tramo);
    return [convertirHoraAMinutos($inicio),convertirHoraAMinutos($fin)];
}

/**
 * Comprueba si un tramo de horas es válido.
 * @param $tramo Tramo a comprobar.
 * @return boolean true si es válido y false en caso contrario.
 */
function comprobarTramoHoras ($tramo)
{
    if (preg_match('/^\d+:\d+-\d+:\d+$/',$tramo))
    {
        $tramoMin=convertirTramoHorasATramoMinutos($tramo);
        if (!in_array(false, $tramoMin, true) && 
            $tramoMin[0]<$tramoMin[1] && $tramoMin[0]>=0 && $tramoMin[1]<1440)
        {
            return true;
        }
    }
    return false;
}

/**
 * Comprueba si $tramo1 está contenido en $tramo2. 
 * @param $tramo1 Tramo válido en formato "hh:mm-hh-mm"
 * @param $tramo2 Tramo válido en formato "hh:mm-hh-mm"
 * @return true si $tramo1 está contenido en $tramo2, false en caso contrario.
 */
function esTramoHorasContenidoEnOtroTramoHoras ($tramo1, $tramo2)
{
    $tramo1Min=convertirTramoHorasATramoMinutos($tramo1);
    $tramo2Min=convertirTramoHorasATramoMinutos($tramo2);
    //Tramo2 contenido en tramo 1
    if ($tramo1Min[0]>=$tramo2Min[0] && $tramo1Min[1]<=$tramo2Min[1])
    {
        return true;
    }
    
    return false;
}

/**
 * Comprueba si dos tramos se pisan.
 * @param $tramo1 Tramo válido en formato "hh:mm-hh-mm"
 * @param $tramo2 Tramo válido en formato "hh:mm-hh-mm"
 * @return string cadena vacía si no se pisan, cadena con texto descriptivo si se pisan.
 */
function comprobarSiSePisanTramosHoras ($tramo1,$tramo2)
{
    $coincidencia='';
    list($TAi, $TAf)=convertirTramoHorasATramoMinutos($tramo1);
    list($TBi, $TBf)=convertirTramoHorasATramoMinutos($tramo2);
    if ($TBi<=$TAi && $TAi<=$TBf 
        || $TBi <= $TAf && $TAf <= $TBf
        || $TAi <= $TBi && $TBi <= $TAf)
        {
            $coincidencia="Tramo $tramo1 coincidente con $tramo2";    
        }    
        
    return $coincidencia;
}

/**
 * Comprueba si un tramo pisa los tramos ocupados.
 * @param $tramo Tramo válido en formato "hh:mm-hh-mm"
 * @param $tramo Array con tramos válidos no solapados en formato "hh:mm-hh-mm"
 * @return array Array con cadenas don las posibles coincidencias. Si no 
 * hubiera coincidencias, retornaría un array vacío.
 */
function comprobarSiPisaTramosOcupados ($tramo, $tramosOcupados)
{
    $coincidencias=[];
    for ($i=0;$i<count($tramosOcupados);$i++)
    {
        $coincidencia=comprobarSiSePisanTramosHoras($tramo,$tramosOcupados[$i]);
        if ($coincidencia)
            $coincidencias[]=$coincidencia;
    }
    return $coincidencias;
}

/**
 * Comprueba si un tramo entra en uno de los tramos de un horario.
 * @param $tramo Tramo válido en formato "hh:mm-hh-mm"
 * @param $tramo Array con tramos válidos no solapados en formato "hh:mm-hh-mm"
 * @return boolean true si entra dentro de uno de los tramos y false en caso 
 * contrario.
 */
function comprobarSiEntraEnHorario ($tramo, $tramosHorario)
{
    $tramoOk=false;
    for ($i=0;$i<count($tramosHorario) && !$tramoOk;$i++)
    {
        $tramoOk=esTramoHorasContenidoEnOtroTramoHoras($tramo,$tramosHorario[$i]);
    }
    return $tramoOk;
}

