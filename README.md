# PHP-gestion-reservas-inicio
## Práctica realizada en el ciclo superior de desarrollo Web (21-22)
### Aplicación sencilla para gestionar reservas vecinos
Varios ejercicios en los que se practica lo siguiente:
- Parámetros pasados vía GET o POST.
  - Uso de los arrays $_GET y/o $_POST.
  - Métodos empty e isset

# Ejercicio 1: normas de uso.
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

#### Elaborar tres scripts php:

DWES01/ejercicio1.php será el script principal que mostrará una norma u otra en función de los parámetros tipo GET que reciba. Para esto deberás usar los scripts cabecera_fecha.php (para añadir la fecha) y config/normas.php (para saber que archivo de normas hay que mostrar).
DWES01/cabecera_fecha.php será un script que mostrará, alineada a la derecha y claramente diferenciada, la fecha de hoy en formato dd/mm/aaaa (ejemplo: 10/12/2021).
DWES01/config/normas.php será un script con información de configuración que contendrá un único array que contendrá el nombre de cada documento de normas ('normas_piscina.html', 'normas_gimnasio.html', 'normas_sala.html', etc.). El contenido de este array deberá usarse obligatoriamente en ejercicio1.php.
La siguiente pregunta a responder es, ¿cómo debe funcionar el script principal? Veamos:

- cuando ponga en el navegador la URL http://localhost/DWES01/ejercicio1.php?ver_norma=np se mostrarán las normas de la piscina.
- cuando ponga en el navegador la URL http://localhost/DWES01/ejercicio1.php?ver_norma=ng se mostrarán las normas del gimnasio.
- cuando ponga en el navegador la URL http://localhost/DWES01/ejercicio1.php?ver_norma=ns se mostrarán las normas de la sala de reuniones.
- cuando en el navegador no se indique la norma (np, ng, ns, etc.) o bien, dicha norma no exista, deberá mostrarse un mensaje de error correspondiente:
  - Que no se ha indicado la norma (si es el caso).
  - Que la norma indicada no existe.

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

# Ejercicio 2: calendario.

En el siguiente ejercicio (DWES01/ejercicio2.php) tienes que hacer un script que muestre una tabla de calendario como la mostrada en la imagen. 


Esta tabla se usará en un futuro para mostrar la ocupación de los diferentes espacios comunes en la aplicación CONVECINOS:
![image](https://user-images.githubusercontent.com/66112531/177489947-701f0663-60a7-4307-afb2-f5f11f61f5d6.png)



Primero veamos cual es el comportamiento esperado del script:

La fecha de comienzo, a partir de la cual se empieza a mostrar el calendario se pasará por parámetro GET en la consulta HTTP, usando los parámetros d (para día), m (para mes) y a (para año). De esta forma, si se pone en la URL: http://localhost/DWES01/ejercicio2.php?d=7&m=10&a=2021, la fecha de comienzo del calendario sería el 7/10/2021. Para el ejemplo de la imagen se ha usado la consulta: http://localhost/DWES01/ejercicio2.php?d=10&m=9&a=2021.
Si no se facilita una fecha válida, el script debe mostrar un mensaje indicando al usuario que no se ha facilitado una fecha válida.
Fíjate que si el día de inicio se muestra sobre el día que le corresponde. El 10/9/2021 del ejemplo cae en Viernes, por eso los días anteriores de esa misma semana aparecen vacíos. Cada día debe por tanto encajar con la columna de día de la semana que le corresponde.
Los días que caen en sábado y domingo aparecerán coloreados de una forma diferente.
El número de semanas a mostrar se podrá cambiar modificando una constante llamada SEMANAS, definida al principio del script. En el ejemplo anterior el valor de SEMANAS es de 8. Tu ejercicio debe funcionar bien sea cual sea el valor del número de SEMANAS.
El código HTML generado debe ser correcto y completo estructuralmente.
Y ahora veamos como puedes enfrentarte al script anterior:

Para verificar si una fecha es correcta, debes usar la función checkdate.
Para manipular fechas, debes usar las siguientes funciones (al final de la página hay enlaces a la documentación PHP):
//date_create: te permite crear un objeto tipo DateTime que contiene una fecha
//Ejemplo (fíjate que primero va el año, luego el mes, y luego el día):
$fecha = date_create ('1883-12-25');

//date_add: te permite añadir un intervalo a una fecha
//date_interval_create_from_date_string: te permite crear un intervalo de tiempo
//Ejemplo en el que se añade un día a una fecha:
date_add($fecha,date_interval_create_from_date_string ('1 day'));

//date_format: te permite obtener la fecha en diferentes formatos
//Ejemplo: obtener el día y el mes de una fecha
echo date_format($fecha, 'd/m'); 
//Ejemplo: obtener el día de la semana de una fecha
echo '<br>';
echo date_format($fecha, 'N');
La cantidad de código del ejercicio es en realidad poca, pero su resolución puede ser un tanto liosa. La solución más sencilla es usar un bucle anidado dentro de otro bucle. Intenta abordar el ejercicio poco a poco, objetivo por objetivo. Ten en mente la idea de que esto podría ser algo que te pidieran en un trabajo real, por lo que intenta elaborar código elegante que otra persona pueda mantener de forma sencilla.
Debes conocer
Las funciones de php están muy bien documentadas en la documentación oficial de PHP. Aquí tienes enlaces a la documentación de las funciones que puedas necesitar:

Función date_create.
Función date_format.
Función checkdate.
Función date_interval_create_from_date_string.
