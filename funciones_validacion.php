<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validaciónh</title>
</head>
<body>
    <?php

    function validarNombre($nombre) {
        // Verifica que el nombre no esté vacío y tenga al menos 2 caracteres
        return !empty($nombre) && strlen($nombre) >= 2;
    }
    
    function validarNoticias($noticias) {
        // Verifica que se haya seleccionado al menos un tema
        return !empty($noticias);
    }
    
    function validarDias($dias) {
        // Verifica que al menos un día esté seleccionado
        return !empty($dias);
    }
    ?>
</body>
</html>