<?php

// Comprobar si no se ha subido ninguna imagen
if (isset($_POST['img'])) {
    if ($_FILES['img']['error'] === 4 && empty($_POST['img'])) {
        echo json_encode(['error' => True, 'message' => "Por favor, sube una imagen."]);
        exit;
    }
} else {
    if(!isset($_FILES['img']) || $_FILES['img']['error'] === 4) {
        echo json_encode(['error' => True, 'message' => "Por favor, sube una imagen."]);
        exit;
    }
}


// Capturar los datos de la imagen
$isUploadedFile = isset($_FILES['img']) && $_FILES['img']['error'] === 0;
$imgName = $isUploadedFile ? $_FILES['img']['name'] : $_POST['img'] ?? null;
$imgTmpName = $isUploadedFile ? $_FILES['img']['tmp_name'] : null;
$imgSize = $isUploadedFile ? $_FILES['img']['size'] : 0;

// Validar que se haya proporcionado un archivo
if ($isUploadedFile && !empty($imgTmpName)) {
    $dataFile = @getimagesize($imgTmpName);

    // Validar tipo de imagen
    $allowedFormats = ['image/png', 'image/jpg', 'image/jpeg', 'image/svg+xml'];
    $mimeType = $dataFile['mime'] ?? mime_content_type($imgTmpName);
    if (!in_array($mimeType, $allowedFormats, true)) {
        echo json_encode(['error' => true, 'message' => "Formato de imagen no válido. Solo se permiten: png, jpg, jpeg, svg."]);
        exit;
    }

    // Validar tamaño
    $maxSize = 1000 * 1024; // 200 KB en bytes
    if ($imgSize > $maxSize) {
        echo json_encode(['error' => True, 'message' => "El tamaño de la imagen no puede exceder de los 500kB."]);
        exit;
    }
}
