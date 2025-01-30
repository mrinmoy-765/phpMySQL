<?php
include 'config.php';

function processForm($conn, $phone, $keyword) {
    // Validate date range
    $currentDate = new DateTime();
    $startDate = new DateTime("2025-01-27");
    $endDate = new DateTime("2025-02-02");
    
    if ($currentDate < $startDate || $currentDate > $endDate) {
        return "দুঃখিত! প্রচারাভিযানটি শুধুমাত্র 27 জানুয়ারী 2025 থেকে 2 ফেব্রুয়ারী 2025 পর্যন্ত চলবে।";
    }

    // Validate SMS format
    if (!preg_match("/^[A-Z]{3}\d{1,} \d{7}$/", $keyword)) {
        return scenarioResponse(3);
    }

    list($ksrCode, $uniqueCode) = explode(' ', $keyword, 2);

    $conn->begin_transaction();
    try {
        // Check if phone number exists
        $stmt = $conn->prepare("SELECT 1 FROM users WHERE phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $stmt->close();
            return scenarioResponse(2);
        }
        $stmt->close();

        // Check if KSR code exists
        $stmt = $conn->prepare("SELECT 1 FROM ksr_code WHERE ksr_code = ?");
        $stmt->bind_param("s", $ksrCode);
        $stmt->execute();
        if ($stmt->get_result()->num_rows == 0) {
            $stmt->close();
            return scenarioResponse(5);
        }
        $stmt->close();

        // Check unique code validity
        $stmt = $conn->prepare("SELECT code_status FROM unique_code WHERE code = ?");
        $stmt->bind_param("s", $uniqueCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $stmt->close();
            return scenarioResponse(7);
        }

        $row = $result->fetch_assoc();
        if ($row['code_status'] !== 'unused') {
            $stmt->close();
            return scenarioResponse(4);
        }
        $stmt->close();

        // Determine the gift
        $gift = determineGift($ksrCode);

        // Insert phone number
        $stmt = $conn->prepare("INSERT INTO users (phone, user_status) VALUES (?, 'notEligible')");
        $stmt->bind_param("s", $phone);
        if (!$stmt->execute()) {
            throw new Exception("Failed to add phone number. Please try again.");
        }
        $stmt->close();

        // Mark unique code as used
        $stmt = $conn->prepare("UPDATE unique_code SET code_status = 'used' WHERE code = ?");
        $stmt->bind_param("s", $uniqueCode);
        if (!$stmt->execute()) {
            throw new Exception("Phone number added, but failed to update code status.");
        }
        $stmt->close();

        $conn->commit();
        return scenarioResponse(1, $gift);
    } catch (Exception $e) {
        $conn->rollback();
        return $e->getMessage();
    }
}

function determineGift($ksrCode) {
    // Define gifts based on KSR codes (example logic, modify as needed)
    $gifts = [
        'KSR1' => 'Top-up',
        'KSR2' => 'Mobile',
        'KSR3' => 'TV'
    ];
    return $gifts[$ksrCode] ?? null;
}

function scenarioResponse($scenario, $gift = null) {
    $responses = [
        1 => "অভিনন্দন! আপনি জিতেছেন {$gift}!",
        2 => "দুঃখিত! আপনার এই নম্বর ইতিমধ্যে ব্যবহার হয়েছে।",
        3 => "আপনার ফরম্যাট ভুল হয়েছে। অনুগ্রহ করে সঠিক ফরম্যাট ব্যবহার করুন।",
        4 => "দুঃখিত! আপনার ইউনিক কোড ইতিমধ্যে ব্যবহৃত হয়েছে।",
        5 => "ভুল KSR কোড! অনুগ্রহ করে সঠিক KSR কোড ব্যবহার করুন।",
        6 => "অভিনন্দন! আপনি জিতেছেন একটি মোবাইল!",
        7 => "দুঃখিত! আপনার ইউনিক কোড অবৈধ।"
    ];
    return $responses[$scenario] ?? "অজানা ত্রুটি ঘটেছে।";
}
?>





