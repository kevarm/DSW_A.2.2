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