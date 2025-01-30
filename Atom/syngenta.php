<?php
include 'config.php';
include 'functions.php';
include 'handleValues.php';


// Handle form submissions
$errorMessage = '';  
$countMessage = '';  

    if (isset($_REQUEST['phone']) && isset($_REQUEST['keyword'])) {
        // Handle first form
        $phone = $_REQUEST['phone'] ?? '';
        $keyword = $_REQUEST['keyword'] ?? '';
        //$currentDate = date("Y-m-d");
        $currentDate = '2025-01-27';
        $errorMessage = processForm($conn, $phone, $keyword, $currentDate);
    } elseif (isset($_REQUEST['phoneCount'])) {
        // Handle  second form
        $phoneCount = $_REQUEST['phoneCount'] ?? '';
        $countMessage = getTotalSMSCount($conn, $phoneCount);
    }

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Atom</title>
    <script>

        function showAlert(message) {
            if (message) {
                alert(message);
            }
        }
    </script>
</head>
<body>

<?php

if ($errorMessage) {
    echo "<script>showAlert('$errorMessage');</script>";
}
if ($countMessage) {
    echo "<script>showAlert('$countMessage');</script>";
}
?>

<div class="flex flex-col justify-center items-center h-screen space-y-4 bg-[url('./bg-shadow.png')] bg-cover bg-center">
    <!-- First Div -->
    <div class="place-self-center border-2 border-indigo-500/75 p-8 rounded">
        <h2 class="text-3xl font-extrabold text-cyan-500">ATOM</h2>
        <form method="POST" action="" class="mt-4">
            <label for="phone">Phone Number (11 digits):</label>
            <input type="text" class="border-2 border-cyan-600 p-2 w-full rounded" id="phone" name="phone">
            <br><br>
            <label for="code">Keyword:</label>
            <input type="text" class="border-2 border-cyan-600 p-2 w-full rounded" id="keyword" name="keyword">
            <br><br>
            <button type="submit" class="rounded-br-lg rounded-bl-lg bg-sky-500 py-4 text-white text-2xl font-bold w-full">Submit</button>
        </form>
        
    </div>

    <!-- Second Div -->
    <!-- <div class="border-4 rounded border-pink-300 p-4 w-2/4">
        <form method="POST" action="">
            <label for="phoneCount">Enter Phone Number:</label>
            <input type="text" class="border-2 border-pink-400 p-2 w-full rounded" id="phoneCount" name="phoneCount">
            <br><br>
            <button type="submit" class="rounded-lg bg-pink-500 py-4 text-white text-2xl font-bold w-full">Get SMS Count!!!</button>
        </form>
    </div> -->
      
    <div>
    <button 
        onclick="window.location.href='report.php'" 
        class="border-2 border-indigo-500/75 py-4 px-40 rounded text-3xl font-bold text-pink-500 hover:bg-indigo-100">
        Get Report
    </button>
    </div>


</div> 
       



</body>
</html>
