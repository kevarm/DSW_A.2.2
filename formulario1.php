<?php
// Default values for the form fields
function load_default_values($file1) {
    $Values2 = array();
    if (file_exists($file1)) {
        $lines = file($file1, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($campo, $value) = explode('=', $line, 2);
            if ($campo == 'interests') {
                $Values2[$campo] = explode(',', $value); // Separar intereses por comas
            } else {
                $Values2[$campo] = $value;
            }
        }
    }
    return $Values2;
}

// Cargar Values2 por defecto desde el archivo
$values = load_default_values('config_values.txt');

// Values2 por defecto si no se cargan correctamente
$values = array_merge(array(
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john.doe@example.com',
    'birth_date' => '1990-01-01',
    'interests' => array('Sports', 'Music'),
    'gender' => 'Male'
), $values);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
</head>
<body>
    <h2>Registration Form</h2>
    <form action="recibe_datos.php" method="POST">

        <!-- Tell the diference between forms  --> 
        <input type="hidden" name="form_type" value="form_david">
        
        <!-- First Name (Text field) -->         
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?= $values['first_name'] ?>"><br>

        <!-- Last Name (Text field) -->
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?= $values['last_name'] ?>"><br>

        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $values['email'] ?>"><br>

        <!-- Date of Birth -->
        <label for="birth_date">Date of Birth:</label>
        <input type="date" id="birth_date" name="birth_date" value="<?= $values['birth_date'] ?>"><br>

        <!-- Interests (Checkbox) -->
        <label>Interests:</label><br>
        <input type="checkbox" name="interests[]" value="Sports" <?php if(in_array('Sports', $values['interests'])) echo 'checked'; ?>> Sports<br>
        <input type="checkbox" name="interests[]" value="Music" <?php if(in_array('Music', $values['interests'])) echo 'checked'; ?>> Music<br>
        <input type="checkbox" name="interests[]" value="Technology" <?php if(in_array('Technology', $values['interests'])) echo 'checked'; ?>> Technology<br>

        <!-- Gender (Select) -->
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="Male" <?php if($values['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if($values['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if($values['gender'] == 'Other') echo 'selected'; ?>>Other</option>
        </select><br><br>

        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
</body>
</html>