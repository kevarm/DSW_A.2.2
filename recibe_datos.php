<?php
    include 'funciones_validacion.php';
    function save_file($file2,$folder = 'ficheros/') {
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $file_name = basename($file2['name']);
        $file_path = $folder . $file_name;

        // If the file exist add a sufix "_N"
        $i = 1;
        while(file_exists($file_path)) {
            $name_no_ext = pathinfo($file_name, PATHINFO_FILENAME);
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_path = $folder . $name_no_ext . "_$i" . $extension;
            $i++;
        }
        
        // Move the uploaded file to the dstination folder
        if (move_uploaded_file($file2['tmp_name'], $file_path)) {
            return true; // Return true if it was correctly uploaded
        }
        return false; // // Return false in case of an error
    }

    function save_form_data($fields, $file2 = 'form_data.txt') {
        $data = "";
        foreach ($fields as $field => $value) {
            if (is_array($value)) {
                $value = implode(',', $value);
            }
            $data .= "$field: $value\n";
        }
        file_put_contents($field, $data, FILE_APPEND);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $form_type = $_POST['form_type'];
        // Validations of form 1
        if ($form_type === "form_david") {
            // Initialize an array to hold error messages
            $errors = array();

            // Get the data from the form (via POST)
            $data = $_POST;

            // Validate the first name
            if (!validate_first_name($data['first_name'])) {
                $errors[] = "The first name is not valid.";
            }

            // Validate the last name
            if (!validate_last_name($data['last_name'])) {
                $errors[] = "The last name is not valid.";
            }

            // Validate the email
            if (!validate_email($data['email'])) {
                $errors[] = "The email is not valid.";
            }

            // Validate the date of birth
            if (!validate_birth_date($data['birth_date'])) {
                $errors[] = "The birth date is not valid.";
            }

            // Validate interests (at least one must be selected)
            if (!isset($data['interests']) || count($data['interests']) == 0) {
                $errors[] = "You must select at least one interest.";
            }

            // Validate gender (must be selected)
            if (!validate_gender($data['gender'])) {
                $errors[] = "You must select a valid gender.";
            }

            if ($_FILES['file1']['error'] == UPLOAD_ERR_OK) {
                if (!save_file($_FILES['file1'])) {
                    $errors[] = "Error uploading file 1";
                }
            }

            if ($_FILES['file2']['error'] == UPLOAD_ERR_OK) {
                if (!save_file($_FILES['file2'])) {
                    $errors[] = "Error uploading file 2";
                }
            }

            // If there are any errors, display them and provide a link to return to the form
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo '<a href="javascript:history.back()">Return to the form</a>';
            } else {
                // If no errors, display the received data
                echo "<h2>Data received successfully:</h2>";
                echo "First Name: " . htmlspecialchars($data['first_name']) . "<br>";
                echo "Last Name: " . htmlspecialchars($data['last_name']) . "<br>";
                echo "Email: " . htmlspecialchars($data['email']) . "<br>";
                echo "Date of Birth: " . htmlspecialchars($data['birth_date']) . "<br>";
                echo "Interests: " . implode(", ", $data['interests']) . "<br>";
                echo "Gender: " . htmlspecialchars($data['gender']) . "<br>";
            }
        // Validaciones del formulario 2
        }elseif ($form_type === 'formulario_kevin') {
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
        }
    }
?>