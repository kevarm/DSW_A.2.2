<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <?php


        $nombre=null;
        $noticias=null;
        $sabado=null;
        $domingo=null;

        $archivo= fopen("default_values.txt","r") or die ("No se pudo leer el archivo");
        $default= [$nombre,$noticias,$sabado,$domingo];
        $contador=0;

        while (!feof($archivo)){
            $default[$contador]= fgets($archivo);
            $contador +=1;
        }

        fclose($archivo);


    ?>
    <form action="./recibe_datos.php" id="form_kevin" method="post" enctype="multipart/form-data">
        <input type="hidden" name="form_type" value="formulario_kevin">
        <label for="nombre"><strong>Nombre:</strong></label>
        <input type="text" id="nombre" value="<?= $default[0] ?>" name="nombre">
        <br>
        <p><strong>Selecciona los temas de los que quieres recibir noticias</strong></p>
        <select multiple name="noticias" id="noticias">
            <option value="economía">Economía</option>
            <option value="cultura" >Cultura</option>
            <option value="ciencia">Ciencia</option>
            <option value="salud" <?=$default[1]?>>Salud</option>
            <option value="deportes">Deportes</option>
            <option value="otros">Otros</option>
        </select>
        <br>
        <p><strong>Selecciona los días que quieres recibir tus noticias</strong></p>
        <input type="checkbox" id="sabado" name="sabado" value="Sabado" <?= $default[2] ?>>
        <label for="sabado">Sábado</label><br>
        <input type="checkbox" id="domingo" name="domingo" value="domingo" <?= $default[3] ?>>
        <label for="domingo">Domingo</label><br><br>
        <input type="file" name="fichero1" id="fichero1">
        <input type="file" name="fichero2" id="fichero2"><br>
        <input type="reset" value="Borrar">
        <input type="submit" value="Enviar">
    </form>
    
</body>
</html>