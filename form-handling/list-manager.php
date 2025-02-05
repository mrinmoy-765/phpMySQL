<?php
session_start();
include 'config.php'; // Database connection

$limit = 50; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$query = "SELECT managername, firstname, lastname, balance, comment, enablemanager FROM rm_managers LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$total_query = "SELECT COUNT(*) AS total FROM rm_managers";
$total_result = $conn->query($total_query);
$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// Query to get the total balance of all records displayed on this page
$total_balance_query = "SELECT SUM(balance) AS total_balance FROM rm_managers LIMIT $limit OFFSET $offset";
$total_balance_result = $conn->query($total_balance_query);

// Check if the result is valid
if ($total_balance_result && $total_balance_result->num_rows > 0) {
    $total_balance = $total_balance_result->fetch_assoc()['total_balance'];
} else {
    // If no result or error, set total_balance to 0
    $total_balance = 0;
}

function generatePagination($page, $total_pages) {
    echo '<div class="pagination">';

    if ($page > 1) {
        echo '<a href="?page=1"><<</a> ';
        echo '<a href="?page=' . ($page - 1) . '"><</a> ';
    }

    for ($i = 1; $i <= min(3, $total_pages); $i++) {
        echo ($page == $i) ? "<strong>$i</strong> " : "<a href='?page=$i'>$i</a> ";
    }

    if ($total_pages > 3) {
        echo '... ';
    }

    if ($page < $total_pages) {
        echo '<a href="?page=' . ($page + 1) . '">></a> ';
        echo '<a href="?page=' . $total_pages . '">>></a>';
    }

    echo '</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Radius Manager - Administration Control Panel</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <style>
        .row-even { background-color: #f9f9f9; }
        .row-odd  { background-color: #eaf1ff; }
        .pagination { text-align: center; margin: 10px 0; }
        .pagination a, .pagination strong {
            padding: 5px 10px;
            margin: 2px;
            text-decoration: none;
            border: 1px solid #007bff;
            color: #007bff;
            border-radius: 5px;
        }
        .pagination a:hover { background-color: #007bff; color: white; }
        .pagination strong { background-color: #007bff; color: white; border: none; }
        .green-bg { background-color: #28a745; color: white; border: 2px solid white }
        .red-bg { background-color: #dc3545; color: white; border:2px solid white }
    </style>
</head>

<body>

    <?php generatePagination($page, $total_pages); ?>

    <table width="100%" border="0" cellpadding="3" cellspacing="0">
        <tr class="tb-header" bgcolor="#dddddd">
            <th>#</th>
            <th><input type="checkbox" id="select" onclick="ToggleCheckBoxes()"></th>
            <th>Manager Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Balance (BDT)</th>
            <th>Comment</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            $count = $offset + 1;
            while ($row = $result->fetch_assoc()) {
                $row_class = ($count % 2 == 0) ? 'row-even' : 'row-odd';
                $managername_encoded = urlencode($row['managername']); // Encode for URL safety
                
                // Determine the background color based on 'enabled' value
                $bg_color = ($row['enablemanager'] == 1) ? 'green-bg' : 'red-bg';
                
                echo "<tr class='{$row_class}'>
                        <td align='center' class='{$bg_color}'>{$count}</td>
                        <td align='center'><input type='checkbox' name='selected[]' value='{$row['managername']}'></td>
                        <td align='center'><a href='edit_manager.php?managername={$managername_encoded}'>{$row['managername']}</a></td>
                        <td align='center'>{$row['firstname']}</td>
                        <td align='center'>{$row['lastname']}</td>
                        <td align='right'>" . number_format($row['balance'], 2) . "</td>
                        <td align='center'>{$row['comment']}</td>
                      </tr>";
                $count++;
            }
        } else {
            echo "<tr><td colspan='7' align='center'>No managers found.</td></tr>";
        }
        ?>

        <!-- Display Total Balance and Total Records -->
        <tr class="tb-footer">
            <td colspan="5" align="right"><strong>Total Balance:</strong></td>
            <td align="right"><strong><?php echo number_format($total_balance, 2); ?> BDT</strong></td>
            <td></td>
        </tr>
        <tr class="tb-footer">
            <td colspan="7" align="center"><strong>Found <?php echo $total_rows; ?> records</strong></td>
        </tr>
        <tr>
          <td colspan="4" class="normal"><strong>Action: 
            <select name="action" class="normal" id="action" onchange="Confirm()">
              <option></option>
              <option value="0">Enable</option>
              <option value="1">Disable</option>
              <option value="2">Delete</option>
            </select>
            </strong> <strong><font color="#00E51B">*Active</font>&nbsp;&nbsp;&nbsp;<font color="#FF3E3E">*Disabled</font></strong> 
          </td>
        </tr>
    </table>

    <?php generatePagination($page, $total_pages); ?>

</body>
</html>

<?php $conn->close(); ?>
