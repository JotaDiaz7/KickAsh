<?php
function validarUser($nombre) {
    // Elimina espacios al principio y al final
    $nombre = trim($nombre);

    // Verifica longitud y que solo tenga letras sin acentos, números y guiones bajos
    if (!preg_match('/^[a-zA-Z0-9_]{1,20}$/', $nombre)) {
        echo json_encode(['error'=> True, 'message' => "Nombre de usuario inválido. Solo se permiten letras sin acentos, números y guiones bajos y sin espacios."]);
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
        echo json_encode(['error'=> True, 'message' => $error]);
        exit;
    }
}

function validarTexto($text)
{
    $text = trim($text);

    if (!preg_match('/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/', $text)) {
        echo json_encode(['error'=> True, 'message' => "Formato campo incorrecto."]);
        exit;
    }
}

function validarPassword($password)
{
    // Elimina espacios al principio y al final
    $password = trim($password);

    // Verifica que tenga al menos 8 caracteres y que no contenga espacios
    if (strlen($password) < 8 || preg_match('/\s/', $password)) {
        echo json_encode(['error'=> True, 'message' => "La contraseña no es válida. Debe tener al menos 8 caracteres y no contener espacios."]);
        exit;
    }
}

//Vamos a hacer una función para validar el precio del artículo
function validarPrecio($precio)
{
    $precio = trim($precio);

    if (!preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $precio) || floatval($precio) < 1) {
        echo json_encode(['error'=> True, 'message' => "Precio no válido."]);
        exit;
    }
}

function validarInt($numero, $campo)
{
    $numero = trim($numero);

    if (!preg_match('/^[0-9]+$/', $numero) || floatval($numero) < 0) {
        echo json_encode(['error'=> True, 'message' => 'Formato de '.$campo.' no válido.']);
        exit;
    }
}
 
function crearIdReto($cadena) {
    // Convertir a minúsculas
    $cadena = mb_strtolower($cadena, 'UTF-8');

    // Reemplazar caracteres acentuados por su equivalente sin tilde
    $acentos = [
        'á'=>'a', 'é'=>'e', 'í'=>'i', 'ó'=>'o', 'ú'=>'u',
        'à'=>'a', 'è'=>'e', 'ì'=>'i', 'ò'=>'o', 'ù'=>'u',
        'ä'=>'a', 'ë'=>'e', 'ï'=>'i', 'ö'=>'o', 'ü'=>'u',
        'ñ'=>'n', 'ç'=>'c'
    ];
    $cadena = strtr($cadena, $acentos);

    // Reemplazar espacios en blanco por guiones bajos
    $cadena = preg_replace('/\s+/', '_', $cadena);

    // Eliminar cualquier otro carácter no alfanumérico excepto guiones bajos
    $cadena = preg_replace('/[^a-z0-9_]/', '', $cadena);

    return $cadena;
}

function generarPasswrod($long = 10) {
    $numeros = '0123456789';
    $letrasMayus = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $letrasMinus = 'abcdefghijklmnopqrstuvwxyz';

    $caracteres = [$numeros, $letrasMayus, $letrasMinus];
    $password = '';

    for ($i = 0; $i < $long; $i++) {
        $grupo = $caracteres[$i % 3];
        $password .= $grupo[random_int(0, strlen($grupo) - 1)];
    }

    return $password;
}
