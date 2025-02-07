<?php

function addManager($conn, $managername, $password1, $password2,
$firstname, $lastname, $company, $address, 
$city, $zip, $country, $state, 
$phone, $mobile, $email, $vatid, 
$lang, $comment, $enablemanager, $permissions) {  


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


$hashed_password = password_hash($password1, PASSWORD_DEFAULT);

// Convert permissions array into individual values
$perm_values = array_values($permissions);

// Generate placeholders dynamically based on permission count
$placeholders = implode(',', array_fill(0, count($perm_values), '?'));

// Prepare SQL query 
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


if ($stmt->execute()) {
    echo "Manager added successfully!";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
}








function updateManager($conn, $managername, $password1, $password2,
$firstname, $lastname, $company, $address, 
$city, $zip, $country, $state, 
$phone, $mobile, $email, $vatid, 
$lang, $comment, $enablemanager, $permissions) {  

    // echo '<pre>';
    // print_r([
    //     'managername' => $managername,
    //     'password1' => $password1,
    //     'password2' => $password2,
    //     'firstname' => $firstname,
    //     'lastname' => $lastname,
    //     'company' => $company,
    //     'permissions' => $permissions
    // ]);
    // echo '</pre>';
    
    //die("Function reached!"); // Stop execution here for debugging


    

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
        if (strlen($password1) < 4 || strlen($password1) > 32) {
            echo "Error: Password must be between 4 and 32 characters.";
            return;
        }

   
        if ($password1 !== $password2) {
            echo "Error: Passwords do not match.";
            return;
        }

        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
        $update_password = true; // Mark password for update
    }

    // Convert permissions array into individual values
    $perm_values = array_values($permissions);
    

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


    //debug
    echo "<pre>";
echo "SQL Query: " . $sql . "<br>";
echo "Params: ";
print_r($params);
echo "</pre>";


    // Execute and check for errors
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Manager updated successfully!";
      //  header("Location: manager-form.php?managername=" . urlencode($managername)); 
      header("Location: manager-form.php"); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

?>






