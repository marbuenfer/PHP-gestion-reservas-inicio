<HTML>
    <head>
        <style>
            .mes { display: block; width:786px; background-color:cyan; text-align:center;padding:10px; margin: 3px}
            .dia { display: inline-block; width:90px; height:50px; text-align:center;padding:10px; margin: 3px}
            .diasem { display: inline-block; width:90px; height:20px; background-color:orange; text-align:center;padding:10px; margin: 3px}
            .normal { background-color:#abf6ab; }
            .findesemana { background-color:#a8dea8; }
        </style>
    </HEAD>
    <BODY>
<?php 

//Definimos las constantes necesarias
define ('SEMANAS', 10);
define ('DIAS_SEMANA',['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo']);
define ('MESES',['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']);

//Función que muestra los días de la semana
function mostrarNombreDias ()
{
    foreach (DIAS_SEMANA as $diasem)
    {
        echo '<div class=\'diasem\'>'; 
        echo $diasem;
        echo '</div>'; 
    }
    echo '<br>';
}

//Calculamos la intersección de $_GET con el array indicado para quedarnos con los datos que nos interesan
// y descartar otros posibles parámetros no deseados
$receivedData=array_intersect_key($_GET,['d'=>'', 'm'=>'', 'a'=>'']);

//Adicionalmente, filtramos aquellos elementos del array cuyo valor no sea numérico
$receivedData=array_filter($receivedData,'is_numeric');

if (count($receivedData)==3 && checkdate($receivedData['m'],$receivedData['d'],$receivedData['a']))
{
    $fecha=date_create($receivedData['a'].'-'.$receivedData['m'].'-'.$receivedData['d']);
}
else {
    echo '<h1>Error en los parámetros. Usando como fecha el día de hoy</h1><br>';
    $fecha=date_create();
}

//Calculamos el mes de inicio y el día de inicio (númericos)
$diaINI=date_format($fecha, 'N');
$mesINI=date_format($fecha, 'm');

//$nm==nuevo mes, será true cuando se cambie de mes. valor inicial = true (se cambia de mes)
$nm=true; 

//Iteramos el número de semanas solicitado
for ($j=0;$j<SEMANAS;$j++)
{
    //Si se cambia de mes, se muetra la cabecera con el mes y los días de la semana.
    if ($nm) {
        echo '<div class=\'mes\'>';
        echo MESES[intval($mesINI)-1];
        echo '</div>';
        mostrarNombreDias();
        //Se añaden los días vacíos necesarios (teniendo en cuenta que el día de inicio puede no ser lunes)
        echo str_repeat('<div class=\'dia\'>--</div>',$diaINI-1);
        $nm=false;
    }
    //Se hace el bucle para mostrar los días de las semana (partiendo del día de inicio)
    for ($i=$diaINI;$i<8 && $nm==false;$i++) 
    {
        //Determinamos la clase css del día en función de si es fin de semana o no
        if ($i>5) $colorclass='findesemana';
        else $colorclass='normal';
        echo "<div class='dia $colorclass'>"; 
        echo date_format($fecha, 'd/m/Y');
        echo '</div>';
        date_add($fecha,date_interval_create_from_date_string ('1 day'));
        $mesNEW=date_format($fecha, 'm');
        if ($mesNEW!=$mesINI) {
            $nm=true;
            $mesINI=$mesNEW;
            $diaINI=($i+1)%7;
        }
    }
    if (!$nm) $diaINI=1;
    echo "<br>";
}
?>
</body>
</html>