<?php

function addManager($conn, $managername, $password1, $password2,
$firstname, $lastname, $company, $address, 
$city, $zip, $country, $state, 
$phone, $mobile, $email, $vatid, 
$lang, $comment, $enablemanager, $permissions) {  

// Validate required fields
if (empty($managername) || empty($password1) || empty($password2)) {
    echo "Error: Manager name, Password, and Confirm Password are required.";
    return;
}

if (strlen($managername) < 4 || strlen($managername) > 32) {
    echo "Error: Manager name must be between 4 and 32 characters.";
    return;
}
if (strlen($password1) < 4 || strlen($password1) > 32) {
    echo "Error: Password must be between 4 and 32 characters.";
    return;
}
if ($password1 !== $password2) {
    echo "Error: Passwords do not match.";
    return;
}

// Hash password
$hashed_password = password_hash($password1, PASSWORD_DEFAULT);

// Convert permissions array into individual values
$perm_values = array_values($permissions);

// Generate placeholders dynamically based on permission count
$placeholders = implode(',', array_fill(0, count($perm_values), '?'));

// Prepare SQL query (including all permissions dynamically)
$stmt = $conn->prepare("INSERT INTO rm_managers 
    (managername, password, firstname, lastname, company, address, 
    city, zip, country, state, phone, mobile, email, vatid, lang, comment, enablemanager,
    " . implode(', ', array_keys($permissions)) . ") 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, $placeholders)");

// Bind parameters dynamically
$stmt->bind_param("sssssssssssssssss" . str_repeat("i", count($perm_values)), 
    $managername, $hashed_password, $firstname, $lastname, $company, $address, 
    $city, $zip, $country, $state, $phone, $mobile, $email, $vatid, 
    $lang, $comment, $enablemanager, ...$perm_values);

// Execute and check for errors
if ($stmt->execute()) {
    echo "Manager added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement
$stmt->close();
}








function updateManager($conn, $managername, $password1, $password2,
$firstname, $lastname, $company, $address, 
$city, $zip, $country, $state, 
$phone, $mobile, $email, $vatid, 
$lang, $comment, $enablemanager, $permissions) {  



    // Check if manager exists and fetch current password
    $stmt = $conn->prepare("SELECT password FROM rm_managers WHERE managername = ?");
    $stmt->bind_param("s", $managername);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo "Error: Manager does not exist.";
        return;
    }

    $stmt->bind_result($current_hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Initialize password update flag
    $update_password = false;
    $hashed_password = $current_hashed_password; // Default to current password

    // Check if user wants to change the password
    if (!empty($password1) || !empty($password2)) {
        // Validate password length
        if (strlen($password1) < 4 || strlen($password1) > 32) {
            echo "Error: Password must be between 4 and 32 characters.";
            return;
        }

        // Check if passwords match
        if ($password1 !== $password2) {
            echo "Error: Passwords do not match.";
            return;
        }

        // Hash the new password
        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
        $update_password = true; // Mark password for update
    }

    // Convert permissions array into individual values
    $perm_values = array_values($permissions);
    
    // Generate SQL query dynamically
    $perm_columns = implode(" = ?, ", array_keys($permissions)) . " = ?";
    $sql = "UPDATE rm_managers SET 
        firstname = ?, lastname = ?, company = ?, address = ?, 
        city = ?, zip = ?, country = ?, state = ?, 
        phone = ?, mobile = ?, email = ?, vatid = ?, 
        lang = ?, comment = ?, enablemanager = ?, $perm_columns";

    // Add password update conditionally
    if ($update_password) {
        $sql .= ", password = ?";
    }

    $sql .= " WHERE managername = ?";

    $stmt = $conn->prepare($sql);

    // Build bind parameter string
    $param_types = "sssssssssssssss" . str_repeat("i", count($perm_values));

    if ($update_password) {
        $param_types .= "s"; // Password type
    }

    $param_types .= "s"; // Manager name type

    // Creating an array of parameters
    $params = [
        $firstname, $lastname, $company, $address, 
        $city, $zip, $country, $state, 
        $phone, $mobile, $email, $vatid, 
        $lang, $comment, $enablemanager
    ];

    // Add permissions dynamically
    foreach ($perm_values as $perm) {
        $params[] = $perm;
    }

    if ($update_password) {
        $params[] = $hashed_password;
    }

    $params[] = $managername;

    // Bind parameters dynamically
    $stmt->bind_param($param_types, ...$params);

    // Execute and check for errors
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Manager updated successfully!";
        header("Location: edit_manager.php?managername=" . urlencode($managername)); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

?>






