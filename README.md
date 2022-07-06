# PHP-gestion-reservas-inicio
Aplicación sencilla para gestionar reservas vecinos
Varios ejercicios en los que se practica lo siguiente:
- Parámetros pasados vía GET o POST.
  - Uso de los arrays $_GET y/o $_POST.
  - Métodos empty e isset

## Ejercicio 1: normas de uso.
En la página principal de CONVECINOS existe un conjunto de información importante, y estas son las normas de uso de cada elemento común. Las normas serán un fragmento de HTML (no un HTML completo), que contendrán la información de uso de cada elemento común. Por ejemplo:

<h1>Normas de uso de la piscina.</h1>
<ul>
<li>La piscina estará abierta desde el 15 de Mayo hasta el 15 de Septiembre.</li>
<li>El horario de la piscina es de 10:00 a 15:00 y de 17:00 a 22:00.</li>
<li>No se puede comer en la piscina ni portar objetos de vídrio.</li>
<li>No se pueden ingerir bebidas alcóholicas en las piscina.</li>
</ul>
Se incluyen las normas para al menos 3 elementos diferentes (piscina, gimnasio y sala de reuniones), aunque puedes incluir más. Estas normas deben almacenarse como fragmentos HTML en los siguientes archivos:

DWES01/normas/normas_piscina.html
DWES01/normas/normas_gimnasio.html
DWES01/normas/normas_sala.html

Elaborartres scripts php:

DWES01/ejercicio1.php será el script principal que mostrará una norma u otra en función de los parámetros tipo GET que reciba. Para esto deberás usar los scripts cabecera_fecha.php (para añadir la fecha) y config/normas.php (para saber que archivo de normas hay que mostrar).
DWES01/cabecera_fecha.php será un script que mostrará, alineada a la derecha y claramente diferenciada, la fecha de hoy en formato dd/mm/aaaa (ejemplo: 10/12/2021).
DWES01/config/normas.php será un script con información de configuración que contendrá un único array que contendrá el nombre de cada documento de normas ('normas_piscina.html', 'normas_gimnasio.html', 'normas_sala.html', etc.). El contenido de este array deberá usarse obligatoriamente en ejercicio1.php.
La siguiente pregunta a responder es, ¿cómo debe funcionar el script principal? Veamos:

cuando ponga en el navegador la URL http://localhost/DWES01/ejercicio1.php?ver_norma=np se mostrarán las normas de la piscina.
cuando ponga en el navegador la URL http://localhost/DWES01/ejercicio1.php?ver_norma=ng se mostrarán las normas del gimnasio.
cuando ponga en el navegador la URL http://localhost/DWES01/ejercicio1.php?ver_norma=ns se mostrarán las normas de la sala de reuniones.
cuando en el navegador no se indique la norma (np, ng, ns, etc.) o bien, dicha norma no exista, deberá mostrarse un mensaje de error correspondiente:
Que no se ha indicado la norma (si es el caso).
Que la norma indicada no existe.
Además, en el script principal (ejercicio1.php) siempre se mostrará la fecha de hoy antes y después del texto de la norma (2 veces), usando para ello el script cabecera_fecha.php.
Por último, para que el ejercicio sea correcto, asegurate que el código HTML generado sea completamente válido.
¡¡IMPORTANTE!! A la hora de realizar estas funciones tienes que tener en cuenta las siguientes restricciones:

Cada archivo tiene su propia misión y no deben mezclarse. Esto es importante, sino el ejercicio estará mal.
En este ejercicio tienes que usar apropiadamente las funciones include_once, include y readfile. Si no se usan adecuadamente el ejercicio no será correcto.
Para mostrar la fecha de hoy puedes usar las funciones date_create (para crear la fecha) y date_format (para mostrar la fecha).
Debes conocer
Las funciones de php están muy bien documentadas en la documentación oficial de PHP.

Se pueden usar las funciones:

Función date_create.
Función date_format.
Función readfile.
