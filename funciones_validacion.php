<?php
    // Function to validate the first name (must be at least 2 characters)
    function validate_first_name($first_name) {
        return !empty($first_name) && strlen($first_name) >= 2;
    }

    // Function to validate the last name (must be at least 2 characters)
    function validate_last_name($last_name) {
        return !empty($last_name) && strlen($last_name) >= 2;
    }

    // Function to validate the email (must be a valid email format)
    function validate_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Function to validate the birth date (must not be empty)
    function validate_birth_date($birth_date) {
        return !empty($birth_date); // You can add additional checks if necessary
    }

    // Function to validate the gender (must be one of the valid options)
    function validate_gender($gender) {
        $valid_genders = array('Male', 'Female', 'Other');
        return in_array($gender, $valid_genders);
    }
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