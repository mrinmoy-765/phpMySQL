<?php
include 'config.php';



// Function to generate a random 7-digit code
function generateRandomCode() {
    return str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numCodes = intval($_POST['num_codes']); 

    if ($numCodes > 0) {
        $insertedCodes = [];
        for ($i = 0; $i < $numCodes; $i++) {
            $code = generateRandomCode();

            // Insert the code into the database with default code_status
            $query = "INSERT INTO Unique_Code (code) VALUES ('$code')";
            if (mysqli_query($conn, $query)) {
                $insertedCodes[] = $code;
            }
        }

        // Display a message for successfully inserted codes
       // echo "<p>Generated and added " . count($insertedCodes) . " codes to the database. All codes are set to 'unused' by default.</p>";
    } else {
       // echo "<p>Please enter a valid number of codes to generate.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Random Unique Codes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-96">
        <h1 class="text-2xl font-bold text-center mb-6">Generate Random Unique Codes</h1>
        <form method="POST" action="">
            <label for="num_codes" class="block text-gray-700 font-medium mb-2">Number of Unique Codes to Generate:</label>
            <input 
                type="number" 
                id="num_codes" 
                name="num_codes" 
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required 
            >
            <button 
                type="submit" 
                class="mt-4 w-full bg-blue-500 text-white font-bold py-2 rounded-lg hover:bg-blue-600 transition duration-300"
            >
                Generate Codes
            </button>
        </form>

        <!-- Message Section -->
        <?php
        // Display a message for successfully inserted codes
        if (!empty($insertedCodes)) {
            echo "<div class='mt-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg'>
                <p class='text-sm font-medium'>Generated and added " . count($insertedCodes) . " codes to the database. All codes are set to 'unused' by default.</p>
            </div>";
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<div class='mt-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg'>
                <p class='text-sm font-medium'>Please enter a valid number of codes to generate.</p>
            </div>";
        }
        ?>
    </div>
</body>
</html>


