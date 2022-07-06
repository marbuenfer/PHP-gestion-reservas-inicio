<?php
include 'ejercicio3_functions.php';
$horario=['10:00-13:30','16:30-20:30'];
$ocupacion=['11:30-12:30','12:31-13:30','16:30-18:00'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <form action="" method="post">
        <label for="tramo">Indique el tramo:<input type="text" name="tramo" id="tramo"></label><br>
        <input type="submit" value="¡Enviar!">
    </form>
    <?php
    
    //Comprobamos si existe el tramo en el parámetro.
    if (isset($_POST['tramo']))
    {
    $tramo=$_POST['tramo'];    
    //Verificamos si el tramo es correcto
    if (comprobarTramoHoras($tramo)) { 
        //Si el tramo es correcto, verificamos si entra en el horario
        if (comprobarSiEntraEnHorario($tramo,$horario))
        {
            //Si el tramo entra en el horario, verificamos si pisa algún tramo ocupado
            $conflictos=comprobarSiPisaTramosOcupados($tramo,$ocupacion);
            if ($conflictos)
            {
                echo "<UL>";
                array_walk($conflictos, function ($item) { echo "<LI>$item</LI>";} );
                echo "</UL>";
            } else {
                echo "<H1> $tramo no tiene conflictos </H1>";
            }
        }
        else
        {
            echo "Tramo $tramo no entra en el horario.";
        } 
    }
    else
    {
        echo "Tramo no válido.";
    }
    }   
    ?>
</body>
</html>