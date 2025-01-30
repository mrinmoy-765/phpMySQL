<?php
include 'config.php';
include 'functions.php';

include 'config.php';

$errorMessage = '';  
$successMessage = '';  // Variable to hold the success message

if (isset($_REQUEST['phone']) && isset($_REQUEST['keyword'])) {
    // Handle form submission
    $phone = $_REQUEST['phone'] ?? '';
    $keyword = $_REQUEST['keyword'] ?? '';
    $currentDate = date("Y-m-d");

  
    $resultMessage = processForm($conn, $phone, $keyword, $currentDate);
    

    // if (strpos($resultMessage, "Found Nothinggg") !== false || strpos($resultMessage, "Invalid format") !== false) {
    //     $errorMessage = $resultMessage;  // Error message
    // } else {
    //     $successMessage = $resultMessage;  // Success message
    // }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Syngenta</title>
</head>
<body>
<div class="flex flex-col justify-center items-center h-screen space-y-4 bg-[url('./bg-shadow.png')] bg-cover bg-center">
    <div class="place-self-center border-2 border-indigo-500/75 p-8 rounded">
        <h2 class="text-3xl font-extrabold text-cyan-500">Syngenta Campaign</h2>
        <form method="POST" action="" class="mt-4">
            <label for="phone">Enter Phone Number:</label>
            <input type="text" class="border-2 border-cyan-600 p-2 w-full rounded" id="phone" name="phone">
            <br><br>
            <label for="code">Enter Code (Format: KSR<Code> <Unique Code>)</label>
            <input type="text" class="border-2 border-cyan-600 p-2 w-full rounded" id="keyword" name="keyword">
            <br><br>
            <button type="submit" class="rounded-br-lg rounded-bl-lg bg-sky-500 py-4 text-white text-2xl font-bold w-full">Submit</button>
        </form>
        
        <?php if ($errorMessage): ?>
            <p class="text-red-500 mt-4"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <?php if ($successMessage): ?>
            <p class="text-green-500 mt-4"><?php echo $successMessage; ?></p>
        <?php endif; ?>
    </div>
    <button 
        onclick="window.location.href='uniqueCode.php'" 
        class="text-sm underline">
        Go to Unique Code
    </button>
</div>

</body>
</html>

