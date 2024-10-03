<?php

    $values = array();

    // Path to the default values file
    $file_path = 'default_values.txt';

    // Open the file and read it line by line
    if (file_exists($file_path)) {
    $file = fopen($file_path, "r");
    
        while (($line = fgets($file)) !== false) {
            // Split the line into key and value
            $parts = explode('=', trim($line));
            if (count($parts) === 2) {
                $key = $parts[0];
                $value = $parts[1];
                // If it's 'interests', convert the string to an array
                if ($key == 'interests') {
                    $values[$key] = explode(',', $value);
                } else {
                    $values[$key] = $value;
                }
            }
        }
        fclose($file); // Close the file after reading
    } else {
        echo "Error: Default values file not found.";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
</head>
<body>
    <h2>Registration Form</h2>
    <form action="recibe_datos.php" method="POST" enctype="multipart/form-data">

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

        <!-- File Upload 1 -->
        <label for="file1">Upload File 1:</label>
        <input type="file" id="file1" name="file1" accept=".jpg, .jpeg, .png, .pdf"><br>

        <!-- File Upload 2 -->
        <label for="file2">Upload File 2:</label>
        <input type="file" id="file2" name="file2" accept=".jpg, .jpeg, .png, .pdf"><br>
        <br>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
</body>
</html>