<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibe datos</title>
</head>
<body>
    <?php
    include 'funciones_validacion.php'; // Incluye el archivo de validaciones

    $nombre = $_POST['nombre'];
    $noticias = isset($_POST['noticias']) ? $_POST['noticias'] : [];
    $dias = [];
    if (isset($_POST['sabado'])) {
        $dias[] = $_POST['sabado'];
    }
    if (isset($_POST['domingo'])) {
        $dias[] = $_POST['domingo'];
    }
    
    // Validar los campos
    $nombreValido = validarNombre($nombre);
    $noticiasValidas = validarNoticias($noticias);
    $diasValidos = validarDias($dias);
    
    // Comprobar si todos los campos son válidos
    if ($nombreValido && $noticiasValidas && $diasValidos) {
        echo "¡Datos enviados correctamente!";
    // Aquí proceso los datos, como guardarlos en una base de datos
    } else {
        echo "Por favor, completa todos los campos requeridos.";
        if (!$nombreValido) {
            echo "
     - El nombre es inválido.";
        }
        if (!$noticiasValidas) {
            echo "
     - Debes seleccionar al menos un tema.";
        }
        if (!$diasValidos) {
            echo "
     - Debes seleccionar al menos un día.";
        }
    }
    ?>
</body>
</html>