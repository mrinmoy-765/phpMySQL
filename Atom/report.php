<?php
include 'config.php';

// Function to fetch total SMS counts for all unique phone numbers
function getAllSMSCounts($conn) {
    $sql = "SELECT phone, SUM(count) AS total_count FROM offers GROUP BY phone ORDER BY phone ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; 
    }

    $stmt->close();
    return $data; 
}

// Function to fetch counts for each keyword
function getKeywordCounts($conn) {
    $sql = "SELECT UPPER(keyword) AS keyword, SUM(count) AS total_count FROM offers GROUP BY keyword ORDER BY keyword ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; 
    }

    $stmt->close();
    return $data;
}

// Fetch data for phone numbers and keyword counts
$phoneData = getAllSMSCounts($conn);
$keywordData = getKeywordCounts($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
      <div class="flex place-content-between">
      <h1 class="text-2xl font-bold mb-4">SMS Count Report</h1>
        <div>
      <button 
        onclick="window.location.href='syngenta.php'" 
        class="border-2  p-2 rounded text-lg font-bold text-white bg-green-600">
       Go to Dashboard
       </button>
      </div>
      </div>
        
        <!-- First Table: Total Counts by Phone Number -->
        <table class="table-auto w-full border-collapse border border-gray-300 mb-8">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Phone Number</th>
                    <th class="border border-gray-300 px-4 py-2">Total Count</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($phoneData)): ?>
                    <?php foreach ($phoneData as $row): ?>
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['total_count']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2" colspan="2">No data available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Second Table: Total Counts by Keyword -->
        <h2 class="text-xl font-bold mb-4">Keyword Count Report</h2>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Keyword</th>
                    <th class="border border-gray-300 px-4 py-2">Total Count</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($keywordData)): ?>
                    <?php foreach ($keywordData as $row): ?>
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['keyword']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['total_count']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2" colspan="2">No data available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>