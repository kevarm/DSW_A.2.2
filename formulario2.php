<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <form action="./recibe_datos.php" id="form_kevin" method="post">
        <input type="hidden" name="form_type" value="formulario_kevin">
        <label for="nombre"><strong>Nombre:</strong></label>
        <input type="text" id="nombre" value="Carolina Pérez" name="nombre">
        <br>
        <p><strong>Selecciona los temas de los que quieres recibir noticias</strong></p>
        <select multiple name="noticias" id="noticias">
            <option selected value="economía">Economía</option>
            <option value="cultura">Cultura</option>
            <option value="ciencia">Ciencia</option>
            <option value="salud">Salud</option>
            <option value="deportes">Deportes</option>
            <option value="otros">Otros</option>
        </select>
        <br>
        <p><strong>Selecciona los días que quieres recibir tus noticias</strong></p>
        <input type="checkbox" id="sabado" name="sabado" value="Sabado" checked>
        <label for="sabado">Sábado</label><br>
        <input type="checkbox" id="domingo" name="domingo" value="Domingo">
        <label for="domingo">Domingo</label><br><br>
        <input type="reset" value="Borrar">
        <input type="submit" value="Enviar">
        
    </form>
    <?php
        $default= array("nombre"=>"Carolina Pérez","noticias"=>"Economía","dias"=>"Sábado")
    ?>
</body>
</html>