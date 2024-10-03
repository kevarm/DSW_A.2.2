<?php
    include 'funciones_validacion.php';
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

            // If there are any errors, display them and provide a link to return to the form
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo '<a href="javascript:history.back()">Return to the form</a>';
            } else {
                // If no errors, store data in a file
                $data_to_store = "Form Type: $form_type\n";
                foreach ($data as $key => $value) {
                    if (is_array($value)) {
                        $data_to_store .= "$key: " . implode(", ", $value) . "\n";
                    } else {
                        $data_to_store .= "$key: $value\n";
                    }
                }

                // Store the data in the file
                file_put_contents($file, $data_to_store, FILE_APPEND | LOCK_EX);
                
                echo "<h2>Data received successfully:</h2>";
                echo nl2br(htmlspecialchars($data_to_store)); // Display the received data
            }
            
            $upload_dir = 'ficheros/';

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);  // Create the folder if it doesn't exist
            }

            for ($i = 1; $i <= 2; $i++) {
                $file_key = 'archivo' . $i;
                if (isset($_FILES[$file_key]) && $_FILES[$file_key]['error'] == UPLOAD_ERR_OK) {
                    $file_name = basename($_FILES[$file_key]['name']);
                    $file_path = $upload_dir . $file_name;
                    
                    // If the file already exists, concatenate "_N" to the name
                    $counter = 1;
                    while (file_exists($file_path)) {
                        $file_name_no_ext = pathinfo($file_name, PATHINFO_FILENAME);
                        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                        $file_path = $upload_dir . $file_name_no_ext . "_" . $counter . "." . $file_ext;
                        $counter++;
                    }
                    
                    move_uploaded_file($_FILES[$file_key]['tmp_name'], $file_path);
                }
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

        $file = 'form_data.txt';
        $data_to_store = '';

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data_to_store .= $key . ": " . implode(", ", $value) . "\n";
            } else {
                $data_to_store .= $key . ": " . $value . "\n";
            }
        }
        file_put_contents($file, $data_to_store, FILE_APPEND);
    }
?>