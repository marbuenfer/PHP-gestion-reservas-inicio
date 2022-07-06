<?php

//Aquí iremos acumulando los errores y los datos correctos
$errores=[];
$datosCorrectos=[];


///// 1º) Descartamos aquellos datos recibidos que no sean los esperados.

//1.1.- Definimos que los campos esperados (minimos y opcionales)
$camposMinimos=['nombre','apellidos','email', 'remail', 'telefono', 'planta', 'puerta', 'password', 'repassword'];
$camposOpts=['garaje','alquilado','trastero'];

//1.2.- Usaremos $fPOST para almacenar los datos POST filtrados

$fPOST=[];

//1.3.- Comprobamos que el campo esté en $camposMinimos, si lo está, lo pegamos a $fPOST
foreach ($_POST as $key=>$value)
{
    if (in_array($key,$camposMinimos) && strlen($value)>0) $fPOST[$key]=$value;
}

//1.4- Recogemos los checkbox (si existen)
$fPOST['opts']=isset($_POST['opts']) && is_array($_POST['opts'])?$_POST['opts']:[];

//1.5.- Repasamos que los checkbox sean los esperados ($camposOpts).
foreach ($fPOST['opts'] as $key=>$value)
{
    if (!in_array($key,$camposOpts)) unset($fPOST[$key]);
}

//1.6.- Verificamos aquellos campos mínimos que no aparezcan
foreach ($camposMinimos as $campo)
{
    if (!array_key_exists($campo,$fPOST))
        $errores[]="No se ha especificado el campo $campo";
}

///// 2º) Comprobamos campo a campo

//Verificamos la longitud mínima del nombre
if (isset($fPOST['nombre'])) {
    $fPOST['nombre']=trim($fPOST['nombre']);
    if (strlen($fPOST['nombre'])<2)
    {
        $errores[]="El nombre no cumnple con la longitud mínima.";
    }
    else
    {
        $datosCorrectos['nombre']=$fPOST['nombre'];
    }
}

//Verificamos la longitud mínima de los apellidos
if (isset($fPOST['apellidos']))
{
    $fPOST['apellidos']=trim($fPOST['apellidos']);    
    if (strlen($fPOST['apellidos'])<2)
    {
        $errores[]="Los apellidos no cumple con la longitud mínima.";
    }
    else
    { 
        $datosCorrectos['apellidos']=$fPOST['apellidos'];
    }
}

//Verificamos que el email sea correcto:

if (isset($fPOST['email']))
{
    $fPOST['email']=strtolower(trim($fPOST['email']));
    if (!$fPOST['email'])
    {
        $errores[]="El email no es válido";
    }
    else
    {
        $datosCorrectos['email']=$fPOST['email'];
    }
}

//Verificamos que la repetición del email sea correcta.
if (isset($datosCorrectos['email']) && isset($fPOST['remail']))
{
    $fPOST['remail']=strtolower(trim($fPOST['remail']));
    if (!$fPOST['remail'])
    {
        $errores[]="La repetición del email no es válida.";
    }
    elseif($fPOST['remail']!=$datosCorrectos['email'])
    {
        $errores[]="La repetición del email no coincide con el email.";
    }
    else
    {
        $datosCorrectos['remail']=$fPOST['remail'];
    }
}

//Si el teléfono existe, verificamos si es correcto

if (isset($fPOST['telefono']))
{
    $fPOST['telefono']=trim($fPOST['telefono']);
    if ($fPOST['telefono']) $datosCorrectos['telefono']=$fPOST['telefono'];
    else $errores[]="El teléfono no es válido.";
}

//Verificamos la planta.
if (isset($fPOST['planta']))
{
    if (!preg_match('/^[0-6]$/',$fPOST['planta']))
    {
        $errores[]="La planta no es correcta.";
    }
    else
    {
        $datosCorrectos['planta']=$fPOST['planta'];
    }
}

//Verificamos la puerta
if (isset($fPOST['puerta']) && isset($fPOST['planta']))
{
    if (preg_match('/^[1]$/',$fPOST['planta']) && preg_match('/^[1-6]$/',$fPOST['puerta'])
        ||
        preg_match('/^[06]$/',$fPOST['planta']) && preg_match('/^[1-4]$/',$fPOST['puerta'])
        ||
        preg_match('/^[2-5]$/',$fPOST['planta']) && preg_match('/^[1-5]$/',$fPOST['puerta'])
    ) {
        $datosCorrectos['puerta']=$fPOST['puerta'];
    } 
    else
    {
        $errores[]="La puerta no es correcta para la planta dada.";
    }
}

//Verificamos el password
if (isset($fPOST['password']) && isset($fPOST['repassword']))
{
   if(strlen($fPOST['password'])<8)
   {
        $errores[]="El password tiene menos de 8 símbolos";
   }
   elseif ($fPOST['password']!=$fPOST['repassword'])
   {
        $errores[]="El password y su repetición no coinciden.";
   } 
}
            
//Verificamos la condición del trastero
if (isset($fPOST['opts'])){
    $datosCorrectos['opts']=array_filter($fPOST['opts'],fn($val)=>$val=='si');
    if (isset($fPOST['opts']['trastero']) && $fPOST['opts']['trastero']=='si'
        && !isset($fPOST['opts']['garaje']) || isset($fPOST['opts']['garaje']) && $fPOST['opts']['garaje']!='si')
    {
        $errores[]="No puede tener un trastero sin garaje.";
    }
}

include 'ejercicio4_form.php';
