<?php

//Vamos a obtener el resto de datos de los artículos mediante el gestor con paginación
$numItemsPag = 10; //Limitamos los elementos que queremos que aparezcan

//inicializamos la página y el inicio para el límite de SQL
$pagina = 1;
$inicio = 0;
//examino la página a mostrar y la muestro si existe
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
    $inicio = ($pagina - 1) * $numItemsPag;
}

