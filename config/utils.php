<?php
function validarUser($nombre) {
    // Elimina espacios al principio y al final
    $nombre = trim($nombre);

    // Verifica longitud y que solo tenga letras sin acentos, números y guiones bajos
    if (!preg_match('/^[a-zA-Z0-9_]{1,20}$/', $nombre)) {
        echo json_encode("Nombre de usuario inválido. Solo se permiten letras sin acentos, números y guiones bajos, sin espacios y con un máximo de 20 caracteres.");
        exit;
    }
}


function validarEmail($correo)
{
    $posicion_arroba = strpos($correo, "@");
    $posicion_punto = strpos($correo, ".", $posicion_arroba);

    if (!$posicion_arroba || !$posicion_punto) {
        $error = "No es una dirección de email válida: ";

        if (!$posicion_arroba) {
            $error .= "Le falta el caracter arroba. ";
        }
        if (!$posicion_punto) {
            $error .= "El dominio no es válido.";
        }
        echo json_encode($error);
        exit;
    }
}

function validarTexto($text, $campo)
{
    $text = trim($text);

    if (!preg_match('/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/', $text)) {
        echo json_encode("Formato campo " . $campo . " incorrecto.");
        exit;
    }
}

function validarPassword($password)
{
    // Elimina espacios al principio y al final
    $password = trim($password);

    // Verifica que tenga al menos 8 caracteres y que no contenga espacios
    if (strlen($password) < 8 || preg_match('/\s/', $password)) {
        echo json_encode("La contraseña no es válida. Debe tener al menos 8 caracteres y no contener espacios.");
        exit;
    }
}

//Vamos a hacer una función para validar el precio del artículo
function validarPrecio($precio)
{
    $precio = trim($precio);

    if (!preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $precio) || floatval($precio) < 1) {
        echo json_encode('precio');
        exit;
    }
}

//Vamos a crear una función para formatear los nombres de las url
function formatearNombre($texto)
{
    $texto = strtolower($texto);

    $texto = str_replace(
        ['á', 'é', 'í', 'ó', 'ú', 'ñ', 'ü', 'ä', 'ö', 'ë', 'ï', 'â', 'ê', 'î', 'ô', 'û'],
        ['a', 'e', 'i', 'o', 'u', 'n', 'u', 'a', 'o', 'e', 'i', 'a', 'e', 'i', 'o', 'u'],
        $texto
    );

    $texto = preg_replace('/[\s\-]+/', '-', $texto);

    $texto = trim($texto, '-');

    return $texto;
}

//Vamos a crearnos una función para crear id de características
function crearIdCaract($texto)
{
    $texto = strtolower($texto);

    $texto = str_replace(
        ['á', 'é', 'í', 'ó', 'ú', 'ñ', 'ü', 'ä', 'ö', 'ë', 'ï', 'â', 'ê', 'î', 'ô', 'û', 'ç'],
        ['a', 'e', 'i', 'o', 'u', 'n', 'u', 'a', 'o', 'e', 'i', 'a', 'e', 'i', 'o', 'u', 'c'],
        $texto
    );

    $texto = preg_replace('/[^a-z0-9]/', '', $texto);

    return $texto;
}