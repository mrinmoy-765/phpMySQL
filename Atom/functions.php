<?php
include 'handleValues.php';

// Function to handle form validation and submission
function processForm($conn, $phone, $keyword, $currentDate) {
    global $startDate, $endDate, $maxLimit;

    $errorMessage = '';

    // Normalizing user input  keyword to lowercase for consistent handling
    $keyword = strtolower($keyword);

    // Validate phone number
    if (!preg_match('/^\d{11}$/', $phone)) {
        $errorMessage = "Phone number must contain 11 digits.";
        logError($conn, $phone, $errorMessage);
        echo $errorMessage;
        die();
    }

    // Validate keyword
    if (!preg_match('/^sk(0[1-9]|[1-4][0-9]|50)(a)?$/', $keyword)) {
        $errorMessage = "Invalid input. The keyword must be in the range SK01-SK50 or SK01A-SK50A.";
        logError($conn, $phone, $errorMessage);
        echo $errorMessage;
        die();
    }

    // Validate date range
    if ($currentDate < $startDate || $currentDate > $endDate) {
        $errorMessage = "This form can only be submitted between $startDate and $endDate.";
        logError($conn, $phone, $errorMessage);
        echo $errorMessage;
        die();
    }

    // Determine the keyword type
    $keywordType = (strpos($keyword, 'a') === false) ? 'normal' : 'A';

    // Query for count of SK% codes (case-insensitive comparison)
    $sqlSK = "
        SELECT COUNT(*) AS count 
        FROM offers 
        WHERE phone = ? 
        AND LOWER(keyword) LIKE 'sk%' 
        AND LOWER(keyword) NOT LIKE 'sk%a' 
        AND date = ?";
    $stmtSK = $conn->prepare($sqlSK);
    $stmtSK->bind_param("ss", $phone, $currentDate);
    $stmtSK->execute();
    $resultSK = $stmtSK->get_result();
    $rowSK = $resultSK->fetch_assoc();
    $countSK = $rowSK['count'];

    // Query for count of SK%A codes (case-insensitive comparison)
    $sqlSKA = "
        SELECT COUNT(*) AS count 
        FROM offers 
        WHERE phone = ? 
        AND LOWER(keyword) LIKE 'sk%a' 
        AND date = ?";
    $stmtSKA = $conn->prepare($sqlSKA);
    $stmtSKA->bind_param("ss", $phone, $currentDate);
    $stmtSKA->execute();
    $resultSKA = $stmtSKA->get_result();
    $rowSKA = $resultSKA->fetch_assoc();
    $countSKA = $rowSKA['count'];

    // Check limits for each type
    if ($keywordType == 'normal' && $countSK >= $maxLimit) {
        $errorMessage = "Keyword limit exceeded for SK% codes. Please try later.";
        logError($conn, $phone, $errorMessage);
        echo $errorMessage;
        die();
    } elseif ($keywordType == 'A' && $countSKA >= $maxLimit) {
        $errorMessage = "Keyword limit exceeded for SK%A codes. Please try later.";
        logError($conn, $phone, $errorMessage);
        echo $errorMessage;
        die();
    } else {
        // Set offer code and count based on the keyword format
        if ($keywordType == 'normal') {
            $offerCode = 'SSDSK_100';
            $count = 1;
        } else {
            $offerCode = 'SSDSK_1000';
            $count = 10;
        }

        // Insert the short code into the database along with the count
        $stmt = $conn->prepare("INSERT INTO offers (phone, keyword, offer_code, date, count) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $phone, $keyword, $offerCode, $currentDate, $count);

        if ($stmt->execute()) {
            $errorMessage = "Success: Offer code: $offerCode sent successfully!";
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    echo $errorMessage;
    die();
}
// Function to log errors in the phone_errors table
function logError($conn, $phone, $errorMessage) {
    $stmt = $conn->prepare("INSERT INTO phone_errors (phone_number, error_message) VALUES (?, ?)");
    $stmt->bind_param("ss", $phone, $errorMessage);
    $stmt->execute();
    $stmt->close();
}


// Function to get total SMS count for a phone number
function getTotalSMSCount($conn, $phone) {
    if (!preg_match('/^\d{11}$/', $phone)) {
        return "Phone number must contain 11 digits.";
    }

    $sql = "SELECT SUM(count) AS total_count FROM offers WHERE phone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['total_count'] !== null) {
        return "Total count for $phone is: " . $row['total_count'];
    } else {
        return "No data found for the given phone number.";
    }
}
?>
