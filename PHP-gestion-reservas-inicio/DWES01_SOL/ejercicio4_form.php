<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

//Valores por defecto para cada campo del formulario.
$defaultValues= ['nombre' => '',
                 'apellidos' => '',
                 'email' => '',
                 'remail' => '',
                 'telefono' => '',
                 'planta' => '',
                 'puerta' => '',
                 'password' => '',
                 'repassword' => '',
                 'opts' => [
                    'garaje' => '',
                    'alquilado' => '',
                    'trastero' => '']
                 ];

//Si no está el array $datosCorrectos, uso los valores por defecto, sino, lo combino con los valores por defecto
if (!isset($datosCorrectos)) 
    $datosCorrectos=$defaultValues;
else
{
    if (isset($datosCorrectos['opts']))
    {
        $datosCorrectos['opts']=array_merge($defaultValues['opts'],$datosCorrectos['opts']);
    }
    $datosCorrectos=array_merge($defaultValues,$datosCorrectos);
    
}
?>

<?php
//Muestro los errores encontrados (si existe $errores):

if (isset($errores)) :
    if (count($errores)>0) : ?>
    <H1>Errores en el formulario</H1>
    <UL>
        <?php foreach ($errores as $error): ?>
            <LI><?=$error?></LI>
        <?php endforeach; ?>
    </UL>
<?php else: ?>
    <h1>Datos correctos, guardando su solicitud.</h1>

<?php endif; 
endif;
?>

<form action="ejercicio4_alta.php" method="post">
<div>
    <div>
        <label>Nombre:
        <input type="text" name="nombre" value="<?=$datosCorrectos['nombre']?>">
        </label>
    </div>
    <div>
        <label>Apellidos:
        <input type="text" name="apellidos" value="<?=$datosCorrectos['apellidos']?>">
        </label>
    </div>
    <div>
        <label>Email:
        <input type="text" name="email" value="<?=$datosCorrectos['email']?>">
        </label>
    </div>
    <div>
        <label>Repetición del email:
        <input type="text" name="remail" value="<?=$datosCorrectos['remail']?>">
        </label>
    </div>
    <div>
        <label>Teléfono: 
        <input type="text" name="telefono" value="<?=$datosCorrectos['telefono']?>">
        </label>
    </div>
    <div>
        <label>Planta: 
        <select name="planta">
            <option value="0" <?=$datosCorrectos['planta']==0?'selected':''?>>Bajo</option>
            <option value="1" <?=$datosCorrectos['planta']==1?'selected':''?>>1ª Planta</option>
            <option value="2" <?=$datosCorrectos['planta']==2?'selected':''?>>2ª Planta</option>
            <option value="3" <?=$datosCorrectos['planta']==3?'selected':''?>>3ª Planta</option>
            <option value="4" <?=$datosCorrectos['planta']==4?'selected':''?>>4ª Planta</option>
            <option value="5" <?=$datosCorrectos['planta']==5?'selected':''?>>5ª Planta</option>
            <option value="6" <?=$datosCorrectos['planta']==6?'selected':''?>>Áticos</option>
        </select>
        </label>
    </div>
    <div>
        <div>
            <label><input name="puerta" type="radio" value="1" <?=$datosCorrectos['puerta']==1?'checked':''?>> Puerta 1</label>
            <label><input name="puerta" type="radio" value="2" <?=$datosCorrectos['puerta']==2?'checked':''?>> Puerta 2</label>
            <label><input name="puerta" type="radio" value="3" <?=$datosCorrectos['puerta']==3?'checked':''?>> Puerta 3</label>
            <label><input name="puerta" type="radio" value="4" <?=$datosCorrectos['puerta']==4?'checked':''?>> Puerta 4</label>
            <label><input name="puerta" type="radio" value="5" <?=$datosCorrectos['puerta']==5?'checked':''?>> Puerta 5</label>
            <label><input name="puerta" type="radio" value="6" <?=$datosCorrectos['puerta']==6?'checked':''?>> Puerta 6</label>
        </div>
    </div>
    <div>
        <label>Password:
        <input type="password" name="password">
        </label>
        
    </div>
    <div>
        <label>Repetición del password:
            <input type="password" name="repassword" >
        </label>
    </div>
    <div>
        <label>Señale de las siguientes casillas las que encajen con su situación:
            <br>
        </label>
        <div>
            <div>
                <input type="checkbox" name="opts[garaje]" value="si" <?=$datosCorrectos['opts']['garaje']=='si'?'checked':''?> >
                <label>Dispongo de una o más plazas de garaje</label>
            </div>
            <div>
                <input type="checkbox" name="opts[alquilado]" value="si" <?=$datosCorrectos['opts']['alquilado']=='si'?'checked':''?>> 
                <label>Piso alquilado</label>                
            </div>
            <div>
                <input type="checkbox" name="opts[trastero]" value="si" <?=$datosCorrectos['opts']['trastero']=='si'?'checked':''?>> 
                <label>Dispongo de uno o más trasteros</label>                
            </div>
        </div>
    </div>
    <div>
        <input type="submit" value="Solicitar alta">
    </div>
</div>
</form>

    
</body>
</html>