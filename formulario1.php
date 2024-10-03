<?php
// Default values for the form fields
$values = array(
    'first_name' => 'John', // Default first name
    'last_name' => 'Doe', // Default last name
    'email' => 'john.doe@example.com', // Default email
    'birth_date' => '1990-01-01', // Default date of birth (YYYY-MM-DD)
    'interests' => array('Sports', 'Music'), // Default selected interests
    'gender' => 'Male' // Default gender
);
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