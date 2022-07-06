<?php
/*Incluimos normas.php con include_once dado que es información de
configuración que solo debería incluirse una vez.
*/
include_once 'config/normas.php';
?>
<html>
    <head>
        <style>
            .error {color:red}
        </style>
    </head>
<body>
<?php
//Incluimos la cabecera con include, dado que debe ser incluida muchas veces
include 'cabecera_fecha.php';

//Verificamos que exista ?ver_norma=...
if (!isset($_GET['ver_norma']))
{
    echo '<h1 class="error">No se ha indicado la norma</h1>';
}
elseif (!isset($normas[$_GET['ver_norma']])) //Si la norma indicada no tiene archivo asociado
{
    echo '<h1 class="error">La norma indicada no existe</h1>';    
}
else
{
    //enviamos al cliente el archivo html (no debe usarse include, dado que solo es html)
    readfile (NORMAS_DIR.$normas[$_GET['ver_norma']]);
}

//Volvemos a incluir la cabecera
include 'cabecera_fecha.php';
?>
</body>
</html>