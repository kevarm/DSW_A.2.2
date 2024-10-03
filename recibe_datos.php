<?php
    include 'funciones_validacion.php';

    // Define the name of the file where data will be stored
    $file = 'form_data.txt';

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
            
            // Initialize an array to hold uploaded file paths
            $uploaded_files = [];

            // Function to handle file uploads
            function handle_file_upload($file_key) {
                $upload_dir = 'files/'; // Directory where files will be saved

                // Check if the file was uploaded
                if (isset($_FILES[$file_key]) && $_FILES[$file_key]['error'] == UPLOAD_ERR_OK) {
                    $original_name = basename($_FILES[$file_key]['name']);
                    $upload_file = $upload_dir . $original_name;
                    $counter = 1;

                    // Check if the file already exists
                    while (file_exists($upload_file)) {
                        // Generate a new file name with a counter
                        $new_name = pathinfo($original_name, PATHINFO_FILENAME) . "_$counter." . pathinfo($original_name, PATHINFO_EXTENSION);
                        $upload_file = $upload_dir . $new_name;
                        $counter++;
                    }

                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($_FILES[$file_key]['tmp_name'], $upload_file)) {
                        return $upload_file; // Return the path of the uploaded file
                    } else {
                        echo "Error uploading file: " . $_FILES[$file_key]['name'];
                    }
                } else {
                  echo "No file uploaded or there was an upload error.";
                }
                return null; // Return null if there was an error
            }

        // Handle each file upload
        $file1_path = handle_file_upload('file1');
        $file2_path = handle_file_upload('file2');

        // Store the uploaded file paths in an array
        if ($file1_path) $uploaded_files[] = $file1_path;
        if ($file2_path) $uploaded_files[] = $file2_path;

        // (Processing form data here)

        // Display uploaded files (if any)
        if (!empty($uploaded_files)) {
            echo "<h2>Uploaded Files:</h2>";
            foreach ($uploaded_files as $file) {
                echo "File: " . htmlspecialchars($file) . "<br>";
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
    }
?>