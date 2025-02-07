<?php
include 'config.php'; 
include 'functions.php';

 // Call addManager function
if (isset($_POST['submit_button'])) {
  if ($_POST['submit_button'] == 'Submit') {
    $managername = $_POST['managername'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $company = $_POST['company'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $phone = $_POST['phone'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $vatid = $_POST['vatid'];
    $lang = $_POST['lang'];
    $comment = $_POST['comment'];
    $enablemanager = isset($_POST['enablemanager']) ? 1 : 0;

   

    $permissions = [
      'perm_listusers' => isset($_POST['perm_listusers']) ? 1 : 0,
      'perm_listmanagers' => isset($_POST['perm_listmanagers']) ? 1 : 0,
      'perm_listservices' => isset($_POST['perm_listservices']) ? 1 : 0,
      'perm_createusers' => isset($_POST['perm_createusers']) ? 1 : 0,
      'perm_createmanagers' => isset($_POST['perm_createmanagers']) ? 1 : 0,
      'perm_createservices' => isset($_POST['perm_createservices']) ? 1 : 0,
      'perm_editusers' => isset($_POST['perm_editusers']) ? 1 : 0,
      'perm_editmanagers' => isset($_POST['perm_editmanagers']) ? 1 : 0,
      'perm_editservices' => isset($_POST['perm_editservices']) ? 1 : 0,
      'perm_edituserspriv' => isset($_POST['perm_edituserspriv']) ? 1 : 0,
      'perm_deletemanagers' => isset($_POST['perm_deletemanagers']) ? 1 : 0,
      'perm_deleteservices' => isset($_POST['perm_deleteservices']) ? 1 : 0,
      'perm_deleteusers' => isset($_POST['perm_deleteusers']) ? 1 : 0,
      'perm_addcredits' => isset($_POST['perm_addcredits']) ? 1 : 0,
      'perm_listinvoices' => isset($_POST['perm_listinvoices']) ? 1 : 0,
      'perm_allusers' => isset($_POST['perm_allusers']) ? 1 : 0,
      'perm_negbalance' => isset($_POST['perm_negbalance']) ? 1 : 0,
      'perm_listallinvoices' => isset($_POST['perm_listallinvoices']) ? 1 : 0,
      'perm_listonlineusers' => isset($_POST['perm_listonlineusers']) ? 1 : 0,
      'perm_allowdiscount' => isset($_POST['perm_allowdiscount']) ? 1 : 0,
      'perm_showinvtotals' => isset($_POST['perm_showinvtotals']) ? 1 : 0,
      'perm_logout' => isset($_POST['perm_logout']) ? 1 : 0,
      'perm_enwriteoff' => isset($_POST['perm_enwriteoff']) ? 1 : 0,
      'perm_editinvoice' => isset($_POST['perm_editinvoice']) ? 1 : 0,
      'perm_cardsys' => isset($_POST['perm_cardsys']) ? 1 : 0,
      'perm_cts' => isset($_POST['perm_cts']) ? 1 : 0,
      'perm_trafficreport' => isset($_POST['perm_trafficreport']) ? 1 : 0,
      'perm_accessap' => isset($_POST['perm_accessap']) ? 1 : 0
  ];


addManager($conn, $managername, $password1, $password2,
    $firstname, $lastname, $company, $address, 
    $city, $zip, $country, $state, 
    $phone, $mobile, $email, $vatid, 
    $lang, $comment, $enablemanager, $permissions); 

  }
}



// method to show  update data starts here



// Initialize variable to avoid "undefined variable" warning
$managername = '';
$firstname = '';
$lastname = '';
$company = '';
  $address ='';
  $city = '';
  $zip = '';
  $country = '';
  $state ='';
  $phone ='';
  $mobile = '';
  $email = '';
  $vatid = '';
  $lang = '';
  $comment = '';
  $enablemanager = '';
  $perm_listusers = '';
  $perm_listmanagers = '';
$perm_listservices = '';
$perm_createusers = '';
$perm_createmanagers = '';
$perm_createservices = '';
$perm_editusers = '';
$perm_editmanagers = '';
$perm_editservices = '';
$perm_edituserspriv = '';
$perm_deletemanagers = '';
$perm_deleteservices = '';
$perm_deleteusers = '';
$perm_addcredits = '';
$perm_listinvoices = '';
$perm_allusers = '';
$perm_negbalance = '';
$perm_listallinvoices = '';
$perm_listonlineusers = '';
$perm_allowdiscount = '';
$perm_showinvtotals = '';
$perm_logout = '';
$perm_enwriteoff = '';
$perm_editinvoice = '';
$perm_cardsys = '';
$perm_cts = '';
$perm_trafficreport = '';
$perm_accessap = '';

  

// Check if managername is passed in the URL
if (isset($_GET['managername'])) {
    $managername = urldecode($_GET['managername']); // Decode URL

    $query = "SELECT * FROM rm_managers WHERE managername = '$managername'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        die("Manager not found!");
    }

    $row = $result->fetch_assoc();

    // Assign values from database row to variables
$firstname = $row['firstname'];  
$lastname = $row['lastname'];    
$company = $row['company'];
$address = $row['address'];
$city = $row['city'];
$zip = $row['zip'];
$country = $row['country'];
$state = $row['state'];
$phone = $row['phone'];
$mobile = $row['mobile'];
$email = $row['email'];
$vatid = $row['vatid'];
$lang = $row['lang'];
$comment = $row['comment'];
$enablemanager = $row['enablemanager'];
$perm_listusers = $row['perm_listusers'];
$perm_listmanagers= $row['perm_listmanagers'];
$perm_listservices=$row['perm_listservices'];
$perm_createusers=$row['perm_createusers'];
$perm_createmanagers=$row['perm_createmanagers'];
$perm_createservices=$row['perm_createservices'];
$perm_editusers=$row['perm_editusers'];
$perm_editmanagers=$row['perm_editmanagers'];
$perm_editservices=$row['perm_editservices'];
$perm_edituserspriv=$row['perm_edituserspriv'];
$perm_deletemanagers=$row['perm_deletemanagers'];
$perm_deleteservices=$row['perm_deleteservices'];
$perm_deleteusers=$row['perm_deleteusers'];
$perm_addcredits=$row['perm_addcredits'];
$perm_listinvoices=$row['perm_listinvoices'];
$perm_allusers=$row['perm_allusers'];
$perm_negbalance=$row['perm_negbalance'];
$perm_listallinvoices=$row['perm_listallinvoices'];
$perm_listonlineusers=$row['perm_listonlineusers'];
$perm_allowdiscount=$row['perm_allowdiscount'];
$perm_showinvtotals=$row['perm_showinvtotals'];
$perm_logout=$row['perm_logout'];
$perm_enwriteoff=$row['perm_enwriteoff'];
$perm_editinvoice=$row['perm_editinvoice'];
$perm_cardsys=$row['perm_cardsys'];
$perm_cts=$row['perm_cts'];
$perm_trafficreport=$row['perm_trafficreport'];
$perm_accessap=$row['perm_accessap'];

}




// method to show user info end here

// Call updateManager function
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['submit_button'] == 'Update') {
   // echo '<pre>'; print_r($_POST); die;
      if (isset($_POST['managername'])) {
        
          $managername = $_POST['managername'];
          $password1 = $_POST['password1'];
          $password2 = $_POST['password2'];
          $firstname = $_POST['firstname'];
          $lastname = $_POST['lastname'];
          $company = $_POST['company'];
          $address = $_POST['address'];
          $city = $_POST['city'];
          $zip = $_POST['zip'];
          $country = $_POST['country'];
          $state = $_POST['state'];
          $phone = $_POST['phone'];
          $mobile = $_POST['mobile'];
          $email = $_POST['email'];
          $vatid = $_POST['vatid'];
          $lang = $_POST['lang'];
          $comment = $_POST['comment'];
          $enablemanager = isset($_POST['enablemanager']) ? 1 : 0;

          // Permissions (checkboxes)
          $permissions = [
              'perm_listusers' => isset($_POST['perm_listusers']) ? 1 : 0,
              'perm_listmanagers' => isset($_POST['perm_listmanagers']) ? 1 : 0,
              'perm_listservices' => isset($_POST['perm_listservices']) ? 1 : 0,
              'perm_createusers' => isset($_POST['perm_createusers']) ? 1 : 0,
              'perm_createmanagers' => isset($_POST['perm_createmanagers']) ? 1 : 0,
              'perm_createservices' => isset($_POST['perm_createservices']) ? 1 : 0,
              'perm_editusers' => isset($_POST['perm_editusers']) ? 1 : 0,
              'perm_editmanagers' => isset($_POST['perm_editmanagers']) ? 1 : 0,
              'perm_editservices' => isset($_POST['perm_editservices']) ? 1 : 0,
              'perm_edituserspriv' => isset($_POST['perm_edituserspriv']) ? 1 : 0,
              'perm_deletemanagers' => isset($_POST['perm_deletemanagers']) ? 1 : 0,
              'perm_deleteservices' => isset($_POST['perm_deleteservices']) ? 1 : 0,
              'perm_deleteusers' => isset($_POST['perm_deleteusers']) ? 1 : 0,
              'perm_addcredits' => isset($_POST['perm_addcredits']) ? 1 : 0,
              'perm_listinvoices' => isset($_POST['perm_listinvoices']) ? 1 : 0,
              'perm_allusers' => isset($_POST['perm_allusers']) ? 1 : 0,
              'perm_negbalance' => isset($_POST['perm_negbalance']) ? 1 : 0,
              'perm_listallinvoices' => isset($_POST['perm_listallinvoices']) ? 1 : 0,
              'perm_listonlineusers' => isset($_POST['perm_listonlineusers']) ? 1 : 0,
              'perm_allowdiscount' => isset($_POST['perm_allowdiscount']) ? 1 : 0,
              'perm_showinvtotals' => isset($_POST['perm_showinvtotals']) ? 1 : 0,
              'perm_logout' => isset($_POST['perm_logout']) ? 1 : 0,
              'perm_enwriteoff' => isset($_POST['perm_enwriteoff']) ? 1 : 0,
              'perm_editinvoice' => isset($_POST['perm_editinvoice']) ? 1 : 0,
              'perm_cardsys' => isset($_POST['perm_cardsys']) ? 1 : 0,
              'perm_cts' => isset($_POST['perm_cts']) ? 1 : 0,
              'perm_trafficreport' => isset($_POST['perm_trafficreport']) ? 1 : 0,
              'perm_accessap' => isset($_POST['perm_accessap']) ? 1 : 0
          ];
          

          // Call the update function
          updateManager($conn, $managername, $password1, $password2,
              $firstname, $lastname, $company, $address, 
              $city, $zip, $country, $state, 
              $phone, $mobile, $email, $vatid, 
              $lang, $comment, $enablemanager, $permissions); 
      } 
  }
}



//pagination logic
$records_per_page = 20;
$pages_display = 10;
$page = isset($_GET['from']) ? (int)$_GET['from'] : 0;

$sql_count = "SELECT COUNT(*) AS total FROM rm_managers";
$result_count = $conn->query($sql_count);
$total_rows = $result_count->fetch_assoc()['total'];

$total_pages = ceil($total_rows / $records_per_page);

$sql = "SELECT * FROM rm_managers LIMIT $page, $records_per_page";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $managers = [];
    while ($row = $result->fetch_assoc()) {
        $managers[] = $row;
    }
} else {
    echo "No managers found.";
}

$current_page_group = floor($page / ($records_per_page * $pages_display)) * $pages_display;
$start_page = $current_page_group + 1;
$end_page = min($start_page + $pages_display - 1, $total_pages);


?>





<html>
    <head>
        <title>Radius Manager - Administration Control Panel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css"></style>
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <link rel="shortcut icon" href="/favicon.ico" />
      
    </head>

    <body
        bgcolor="#FFFFFF"
        text="#000000"
        link="#0000FF"
        vlink="#0000FF"
        leftmargin="0"
        topmargin="0"
        marginwidth="0"
        marginheight="0"
    >
    <!-- table structure -->

   <div  id="tableContainer">
   <table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#EAF1FF">
        <tbody>
            <tr>
                <td>
                    <link href="styles.css" rel="stylesheet" type="text/css">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="1" class="tb-bdr">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table width="100%" border="0" cellpadding="2" cellspacing="0" class="tb-bg">
                                                        <tbody>
                                                            <tr>
                                                                <td class="modtext">List managers</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="images/spacer.gif" width="1" height="2"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <div style="padding-left: 10px;padding-right: 110px; font-weight: 600; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                                <span>Found: <?= $total_rows ?></span>
                                <button  id="showForm">Add Manager</button>
                            </div>
                            <form method="post" action="manager-form.php"></form>
                            <tr>
                                <td colspan="4">
                                    <table width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="">
                                        <tbody>
                                            <tr class="tb-header" bgcolor="#dddddd">
                                                <th width="20" height="20" nowrap="" align="center">
                                                    <font color="#000000">#</font>
                                                </th>
                                                <th height="20" nowrap="" align="center">
                                                    <font color="#000000">Manager name</font>
                                                </th>
                                                <th height="20" nowrap="" align="center">
                                                    <font color="#000000">First name</font>
                                                </th>
                                                <th height="20" nowrap="" align="center">
                                                    <font color="#000000">Last name</font>
                                                </th>
                                                <th height="20" nowrap="" align="center">
                                                    <font color="#000000">Balance (BDT)</font>
                                                </th>
                                                <th height="20" nowrap="" align="center">
                                                    <font color="#000000">Comment</font>
                                                </th>
                                            </tr>
                                            <?php foreach ($managers as $index => $manager): ?>
                                                <tr class="normal" bgcolor="<?= ($index % 2 == 0) ? '#E0E0E0' : '#F0F0F0' ?>">
                                                    <td height="20" bgcolor="<?= ($manager['enablemanager'] == '1') ? '#00E51B' : '#FF3E3E'; ?>" nowrap="" align="center">
                                                        <font color="#000000"><?= $index + 1 ?>.</font>
                                                    </td>
                                                    <td height="20" nowrap="" align="left">
                                                    <font color="#000000">
    <a href="manager-form.php?managername=<?= $manager['managername'] ?>"
       onclick="showEditForm();"><?= $manager['managername'] ?></a>
</font>

                                                    </td>
                                                    <td height="20" nowrap="" align="left">
                                                        <font color="#000000"><?= $manager['firstname'] ?></font>
                                                    </td>
                                                    <td height="20" nowrap="" align="left">
                                                        <font color="#000000"><?= $manager['lastname'] ?? 'NA' ?></font>
                                                    </td>
                                                    <td height="20" nowrap="" align="right">
                                                        <font color="#000000"><?= number_format($manager['balance'], 2) ?></font>
                                                    </td>
                                                    <td height="20" nowrap="" align="left">
                                                        <font color="#000000"><?= $manager['comment'] ?? 'NA' ?></font>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr class="bold" bgcolor="#EAF1FF">
                                                <td height="20" nowrap="" align="center">
                                                    <font color="#000000"></font>
                                                </td>
                                                <td height="20" nowrap="" align="center">
                                                    <font color="#000000"></font>
                                                </td>
                                                <td height="20" nowrap="" align="center">
                                                    <font color="#000000"></font>
                                                </td>
                                                <td height="20" nowrap="" align="center">
                                                    <font color="#000000"></font>
                                                </td>
                                                <td height="20" nowrap="" align="center">
                                                    <font color="#000000"></font>
                                                </td>
                                                <td height="20" nowrap="" align="right">
                                                    <font color="#000000">TOTALS: -44 444 029 650.30</font>
                                                </td>
                                                <td height="20" nowrap="" align="left">
                                                    <font color="#000000">BDT</font>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="normal"><strong>Action:
                                        <select name="action" class="normal" id="action" onchange="Confirm()">
                                            <option></option>
                                            <option value="0">Enable</option>
                                            <option value="1">Disable</option>
                                            <option value="2">Delete</option>
                                        </select>
                                    </strong> <strong>
                                        <font color="#00E51B">*Active</font>&nbsp;&nbsp;&nbsp;<font color="#FF3E3E">*Disabled</font>
                                    </strong>
                                </td>
                            </tr>
                            <tr align="center">
    <td colspan="6" class="normal">
        <div class="pagination">
            
            <!-- Show "First" button only if we are not on the first page -->
            <?php if ($page > 0): ?>
                <a style="padding: 3px; background-color: #DEE5F2; color: #0033FF;" class="pagination-a" href="manager-form.php?cont=list_managers&from=0">First</a>
            <?php endif; ?>

            <!-- Show "Back" button only if we are not on the first page -->
            <?php if ($page > 0): ?>
                <a style="padding: 3px; background-color: #DEE5F2; color: #0033FF;" class="pagination-a" href="manager-form.php?cont=list_managers&from=<?= max($page - $records_per_page, 0) ?>">&lt;&lt; Back</a>
            <?php endif; ?>

            <!-- Page Numbers -->
            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                <a style="padding: 3px; background-color: #DEE5F2; color: #0033FF;" class="pagination-a" href="manager-form.php?cont=list_managers&from=<?= ($i - 1) * $records_per_page ?>"><?= $i ?></a>
            <?php endfor; ?>

            <!-- Show "Next" button only if we are not on the last page -->
            <?php if ($end_page < $total_pages): ?>
                <a style="padding: 3px; background-color: #DEE5F2; color: #0033FF;" class="pagination-a" href="manager-form.php?cont=list_managers&from=<?= min($page + $records_per_page, ($total_pages - 1) * $records_per_page) ?>">Next &gt;&gt;</a>
            <?php endif; ?>

            <!-- Show "Last" button only if we are not on the last page -->
            <?php if ($page < ($total_pages - 1) * $records_per_page): ?>
                <a style="padding: 3px; background-color: #DEE5F2; color: #0033FF;" class="pagination-a" href="manager-form.php?cont=list_managers&from=<?= ($total_pages - 1) * $records_per_page ?>">Last</a>
            <?php endif; ?>

        </div>
    </td>
</tr>


                        </tbody>
                    </table>

                    <script language="JavaScript" src="helper.js" type="text/JavaScript">
                    </script>
                </td>
            </tr>
        </tbody>
    </table>

   </div>



    <!-- form html structure -->
      <div id="formContainer" class="hidden">
      <table
            width="100%"
            border="0"
            cellpadding="3"
            cellspacing="0"
            bgcolor="#EAF1FF"
        >
            <tbody>
                <tr>
                    <td>
                        <link
                            rel="stylesheet"
                            href="styles.css"
                            type="text/css"
                        />
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <table
                                            border="0"
                                            cellpadding="0"
                                            cellspacing="1"
                                            class="tb-bdr"
                                         >
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table
                                                            width="100%"
                                                            border="0"
                                                            cellpadding="2"
                                                            cellspacing="0"
                                                            class="tb-bg"
                                                        >
                                                            <tbody>
                                                                <tr>
                                                                    <td
                                                                        class="modtext"
                                                                    >
                                                                        New
                                                                        manager
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img
                                            src="images/spacer.gif"
                                            width="1"
                                            height="2"
                                        />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table
                            width="80%"
                            border="0"
                            align="center"
                            cellpadding="5"
                            cellspacing="0"
                            class="tb-bg"
                        >
                            <tbody>
                                <tr>
                                    <td>
                                        <form
                                            action=""
                                            method="post"
                                            name="form1"
                                            id="form1"
                                        >
                                            <p align="center" class="title2">
                                                <font color="#FF0000"></font>
                                            </p>
                                            <table
                                                width="80%"
                                                border="0"
                                                align="center"
                                                cellpadding="2"
                                                cellspacing="2"
                                            >
                                                <tbody>
                                                    <tr>
                                                        <td
                                                            colspan="6"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <table
                                                                width="100%"
                                                                border="0"
                                                                align="center"
                                                                cellpadding="2"
                                                                cellspacing="0"
                                                            >
                                                                <tbody>
                                                                    <tr>
                                                                        <td
                                                                            width="50%"
                                                                        >
                                                                            <hr />
                                                                        </td>
                                                                        <td
                                                                            nowrap=""
                                                                        >
                                                                            <div
                                                                                align="center"
                                                                            >
                                                                                <p
                                                                                    class="title3"
                                                                                >
                                                                                    General
                                                                                    data
                                                                                </p>
                                                                            </div>
                                                                        </td>
                                                                        <td
                                                                            width="50%"
                                                                        >
                                                                            <hr />
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Enable:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="enablemanager"
                                                                type="checkbox"
                                                                id="enablemanager"
                                                                value=""
                                                              
                                                                <?php echo ($enablemanager == 1) ? 'checked' : ''; ?>>
                                                            
                                                        </td>
                                                    </tr>

                                                    <!-- new testing block here -->

                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                <font
                                                                    color="#FF0000"
                                                                    >*</font
                                                                >
                                                                Manager name:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                        <input
    name="managername"
    type="text"
    class="normal"
    id="managername"
    value="<?php echo $managername; ?>"
    size="32"
    maxlength="32"
    <?php echo !empty($managername) ? 'readonly' : ''; ?>>

                                                            (4-32 characters)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                <font
                                                                    color="#FF0000"
                                                                    >*</font
                                                                >
                                                                Password
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="password1"
                                                                type="password"
                                                                class="normal"
                                                                id="password2"
                                                                value=""
                                                                placeholder="Enter password"
                                                                size="18"
                                                                maxlength="32"
                                                            />
                                                            (4-32 characters)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                <font
                                                                    color="#FF0000"
                                                                    >*</font
                                                                >
                                                                Confirm
                                                                password:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="password2"
                                                                type="password"
                                                                class="normal"
                                                                id="password2"
                                                                value=""
                                                                placeholder="Confirm Password"
                                                                size="18"
                                                                maxlength="32"
                                                            />
                                                            (4-32 characters)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                First name:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="firstname"
                                                                type="text"
                                                                class="normal"
                                                                id="realname3"
                                                                value="<?php echo $firstname; ?>"
                                                                size="50"
                                                                maxlength="50"
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Last (family)
                                                                name:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="lastname"
                                                                type="text"
                                                                class="normal"
                                                                id="realname3"
                                                                value="<?php echo $lastname; ?>"
                                                                size="50"
                                                                maxlength="50"
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Company name:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="company"
                                                                type="text"
                                                                class="normal"
                                                                id="company"
                                                                value="<?php echo $company; ?>"
                                                                maxlength="50"
                                                                size="50"
                                                                {en_company}=""
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Address:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="address"
                                                                type="text"
                                                                class="normal"
                                                                id="address3"
                                                                value="<?php echo $address; ?>"
                                                                size="50"
                                                                maxlength="50"
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                City:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="city"
                                                                type="text"
                                                                class="normal"
                                                                id="city3"
                                                                value="<?php echo $city; ?>"
                                                                size="15"
                                                                maxlength="15"
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                ZIP:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="zip"
                                                                type="text"
                                                                class="normal"
                                                                id="zip3"
                                                                value="<?php echo $zip; ?>"
                                                                size="8"
                                                                maxlength="8"
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Country:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <strong>
                                                                <select
                                                                    name="country"
                                                                    class="normal"
                                                                    id="country"
                                                                    {en_country}=""
                                                                >
                                                                    <option
                                                                        selected=""
                                                                        value="<?php echo $country; ?>"
                                                                    ></option>
                                                                    <option
                                                                        value="Retail"
                                                                    >
                                                                        Retail
                                                                    </option>
                                                                    <option
                                                                        value="Retail-FOC"
                                                                    >
                                                                        Retail-FOC
                                                                    </option>
                                                                    <option
                                                                        value="Office-FOC"
                                                                    >
                                                                        Office-FOC
                                                                    </option>
                                                                    <option
                                                                        value="Retail-VIP"
                                                                    >
                                                                        Retail-VIP
                                                                    </option>
                                                                    <option
                                                                        value="CFB"
                                                                    >
                                                                        CFB
                                                                    </option>
                                                                    <option
                                                                        value="CFB-FOC"
                                                                    >
                                                                        CFB-FOC
                                                                    </option>
                                                                    <option
                                                                        value="CFB-VIP"
                                                                    >
                                                                        CFB-VIP
                                                                    </option>
                                                                    <option
                                                                        value="Wifi-Haat"
                                                                    >
                                                                        Wifi-Haat
                                                                    </option>
                                                                    <option
                                                                        value="LISP"
                                                                    >
                                                                        LISP
                                                                    </option>
                                                                    <option
                                                                        value="Partner"
                                                                    >
                                                                        Partner
                                                                    </option>
                                                                    <option
                                                                        value="SVP"
                                                                    >
                                                                        SVP
                                                                    </option>
                                                                </select>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                State:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <select
                                                                name="state"
                                                                class="normal"
                                                                id="state"
                                                                {en_state}=""
                                                            >
                                                                <option
                                                                    selected=""
                                                                    value="<?php echo $state; ?>"
                                                                ></option>
                                                                <option
                                                                    value="Active"
                                                                >
                                                                    Active
                                                                </option>
                                                                <option
                                                                    value="Discontinue"
                                                                >
                                                                    Discontinue
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Phone number:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="phone"
                                                                type="text"
                                                                class="normal"
                                                                id="phone3"
                                                                value="<?php echo $phone; ?>"
                                                                size="15"
                                                                maxlength="15"
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Mobile number:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="mobile"
                                                                type="text"
                                                                class="normal"
                                                                id="phone3"
                                                                value="<?php echo $mobile; ?>"
                                                                size="15"
                                                                maxlength="15"
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Email:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="email"
                                                                type="text"
                                                                class="normal"
                                                                id="email"
                                                                value="<?php echo $email; ?>"
                                                                maxlength="50"
                                                                size="50"
                                                                {en_email}=""
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                VAT ID:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="vatid"
                                                                type="text"
                                                                class="normal"
                                                                id="vatid"
                                                                value="<?php echo $vatid; ?>"
                                                                maxlength="40"
                                                                size="40"
                                                                {en_taxid}=""
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Language:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <strong>
                                                                <select
                                                                    name="lang"
                                                                    class="normal"
                                                                    id="lang"
                                                                >
                                                                    <option
                                                                        value="English"
                                                                    >
                                                                        English
                                                                    </option>
                                                                </select>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            colspan="2"
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Comment:
                                                            </div>
                                                        </td>
                                                        <td
                                                            colspan="4"
                                                            class="normal"
                                                        >
                                                            <input
                                                                name="comment"
                                                                type="text"
                                                                class="normal"
                                                                id="comment3"
                                                                value="<?php echo $comment; ?>"
                                                                size="50"
                                                                maxlength="200"
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <!-- new testing block ends here -->

                                                        <td
                                                            colspan="6"
                                                            nowrap=""
                                                            class="title3"
                                                        >
                                                            <table
                                                                width="100%"
                                                                border="0"
                                                                align="center"
                                                                cellpadding="2"
                                                                cellspacing="0"
                                                            >
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            &nbsp;
                                                                        </td>
                                                                        <td
                                                                            nowrap=""
                                                                        >
                                                                            &nbsp;
                                                                        </td>
                                                                        <td>
                                                                            &nbsp;
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td
                                                                            width="50%"
                                                                        >
                                                                            <hr />
                                                                        </td>
                                                                        <td
                                                                            nowrap=""
                                                                        >
                                                                            <div
                                                                                align="center"
                                                                            >
                                                                                <p
                                                                                    class="title3"
                                                                                >
                                                                                    Permissions
                                                                                </p>
                                                                            </div>
                                                                        </td>
                                                                        <td
                                                                            width="50%"
                                                                        >
                                                                            <hr />
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                List users:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_listusers"
                                                            type="checkbox"
                                                            id="perm_listusers"
                                                            value="1"
                                                            <?php echo ($perm_listusers == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                List managers:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_listmanagers"
                                                            type="checkbox"
                                                            id="perm_listmanagers"
                                                            value="1"
                                                            <?php echo ($perm_listmanagers == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                List services:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_listservices"
                                                            type="checkbox"
                                                            id="perm_listservices"
                                                            value="1"
                                                            <?php echo ($perm_listservices == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Register users:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_createusers"
                                                            type="checkbox"
                                                            id="perm_createusers"
                                                            value="1"
                                                            <?php echo ($perm_createusers == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Register
                                                                managers:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_createmanagers"
                                                            type="checkbox"
                                                            id="perm_createmanagers"
                                                            value="1"
                                                            <?php echo ($perm_createmanagers == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Register
                                                                services:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_createservices"
                                                            type="checkbox"
                                                            id="perm_createservices"
                                                            value="1"
                                                            <?php echo ($perm_createservices == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Edit users:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_editusers"
                                                            type="checkbox"
                                                            id="perm_editusers"
                                                            value="1"
                                                            <?php echo ($perm_editusers == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Edit managers:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_editmanagers"
                                                            type="checkbox"
                                                            id="perm_editmanagers"
                                                            value="1"
                                                            <?php echo ($perm_editmanagers == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Edit services:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_editservices"
                                                            type="checkbox"
                                                            id="perm_editservices"
                                                            value="1"
                                                            <?php echo ($perm_editservices == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Edit privileged
                                                                user data:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_edituserspriv"
                                                            type="checkbox"
                                                            id="perm_edituserspriv"
                                                            value="1"
                                                            <?php echo ($perm_edituserspriv == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Delete managers:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_deletemanagers"
                                                            type="checkbox"
                                                            id="perm_deletemanagers"
                                                            value="1"
                                                            <?php echo ($perm_deletemanagers == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Delete services:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_deleteservices"
                                                            type="checkbox"
                                                            id="perm_deleteservices"
                                                            value="1"
                                                            <?php echo ($perm_deleteservices == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Delete users:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_deleteusers"
                                                            type="checkbox"
                                                            id="perm_deleteusers"
                                                            value="1"
                                                            <?php echo ($perm_deleteusers == 1) ? 'checked' : ''; ?>>
                                                        </td>

                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Billing
                                                                functions:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_addcredits"
                                                            type="checkbox"
                                                            id="perm_addcredits"
                                                            value="1"
                                                            <?php echo ($perm_addcredits == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Access invoices:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_listinvoices"
                                                            type="checkbox"
                                                            id="perm_listinvoices"
                                                            value="1"
                                                            <?php echo ($perm_listinvoices == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Access all
                                                                users:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_allusers"
                                                            type="checkbox"
                                                            id="perm_allusers"
                                                            value="1"
                                                            <?php echo ($perm_allusers == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Allow negative
                                                                balance:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_negbalance"
                                                            type="checkbox"
                                                            id="perm_negbalance"
                                                            value="1"
                                                            <?php echo ($perm_negbalance == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Access all
                                                                invoices:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_listallinvoices"
                                                            type="checkbox"
                                                            id="perm_listallinvoices"
                                                            value="1"
                                                            <?php echo ($perm_listallinvoices == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                List online
                                                                users:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_listonlineusers"
                                                            type="checkbox"
                                                            id="perm_listonlineusers"
                                                            value="1"
                                                            <?php echo ($perm_listonlineusers == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Allow discount
                                                                prices:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_allowdiscount"
                                                            type="checkbox"
                                                            id="perm_allowdiscount"
                                                            value="1"
                                                            <?php echo ($perm_allowdiscount == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Accounting
                                                                summary:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_showinvtotals"
                                                            type="checkbox"
                                                            id="perm_showinvtotals"
                                                            value="1"
                                                            <?php echo ($perm_showinvtotals == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Disconnect
                                                                users:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_logout"
                                                            type="checkbox"
                                                            id="perm_logout"
                                                            value="1"
                                                            <?php echo ($perm_logout == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Enable canceling
                                                                invoices:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_enwriteoff"
                                                            type="checkbox"
                                                            id="perm_enwriteoff"
                                                            value="1"
                                                            <?php echo ($perm_enwriteoff == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Edit invoices:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_editinvoice"
                                                            type="checkbox"
                                                            id="perm_editinvoice"
                                                            value="1"
                                                            <?php echo ($perm_editinvoice == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Card system
                                                                &amp; IAS:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_cardsys"
                                                            type="checkbox"
                                                            id="perm_cardsys"
                                                            value="1"
                                                            <?php echo ($perm_cardsys == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Connection
                                                                report:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_cts"
                                                            type="checkbox"
                                                            id="perm_cts"
                                                            value="1"
                                                            <?php echo ($perm_cts == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Overall traffic
                                                                report:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_trafficreport"
                                                            type="checkbox"
                                                            id="perm_trafficreport"
                                                            value="1"
                                                            <?php echo ($perm_trafficreport == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <div align="right">
                                                                Maintain APs:
                                                            </div>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            <input
                                                            name="perm_accessap"
                                                            type="checkbox"
                                                            id="perm_accessap"
                                                            value="1"
                                                            <?php echo ($perm_accessap == 1) ? 'checked' : ''; ?>>
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                        <td
                                                            nowrap=""
                                                            class="normal"
                                                        >
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p align="center">
                                                <input
                                                    name="checkall"
                                                    type="button"
                                                    class="normal"
                                                    id="checkall"
                                                    value="Check all"
                                                    onclick="checkAllCheckboxes(true)"
                                                />
                                                <input
                                                    name="clearall"
                                                    type="button"
                                                    class="normal"
                                                    id="clearall"
                                                    value="Clear all"
                                                    onclick="checkAllCheckboxes(false)"
                                                />
                                            </p>
                                            <p align="center" class="normal">
                                                <font color="#FF0000">*</font>
                                                Fields are mandatory!
                                            </p>
                                            <p align="center" class="normal">
                                                <!-- <input type="submit" name="Submit" value="Add manager"> -->
                                                <!-- <input type="submit" value="<?php echo empty($managername) ? 'Submit' : 'Update'; ?>"> -->
                                                <input
                                                    type="submit"
                                                    value="<?php echo empty($managername) ? 'Submit' : 'Update'; ?>"
                                                    name="submit_button"
                                                />
                                                  
                                                <script type="text/javascript">
    focusField("managername");
    function focusField(name)
    {
      for(var i = 0; i < document.forms.length; ++i) {
        var obj = document.forms[i].elements[name];
        if (obj) {
          if (obj.length) { obj = obj[0]; }
          if (obj.focus) { obj.focus(); }
        }
      }
    } 
    function checkAllCheckboxes(flag)
    {
      for (var i = 0; i < form1.elements.length;i++)
      {
        var e = form1.elements[i];
        if ( e.type=='checkbox' )
            e.checked = flag;
      }
    }
    </script>
                                                
                                            </p>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
      </div>
    </body>

<script>
    document.getElementById("showForm").addEventListener("click", function () {
    document.getElementById("tableContainer").classList.add("hidden");
    document.getElementById("formContainer").classList.remove("hidden");
});

document.addEventListener("DOMContentLoaded", function () {
    // Function to get URL parameters
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }
});

const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has("managername")) { 
    document.getElementById("tableContainer").classList.add("hidden");
    document.getElementById("formContainer").classList.remove("hidden");
}


</script>

</html>
