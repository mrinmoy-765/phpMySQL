<?php
include 'config.php'; 
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Submit'])) {
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
?>





<html>
    <head>
        <title>Radius Manager - Administration Control Panel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style type="text/css"></style>
        <link rel="stylesheet" href="styles.css" type="text/css">
        <link rel="shortcut icon" href="/favicon.ico" />
    </head>
    
    <body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#EAF1FF">
            <tbody><tr> 
              <td> 
    <link rel="stylesheet" href="styles.css" type="text/css">
    <table border="0" cellspacing="0" cellpadding="0">
      <tbody><tr> 
        <td><table border="0" cellpadding="0" cellspacing="1" class="tb-bdr">
            <tbody><tr> 
              <td><table width="100%" border="0" cellpadding="2" cellspacing="0" class="tb-bg">
                  <tbody><tr> 
                    <td class="modtext">New manager</td>
                  </tr>
                </tbody></table></td>
            </tr>
          </tbody></table></td>
      </tr>
      <tr> 
        <td><img src="images/spacer.gif" width="1" height="2"></td>
      </tr>
    </tbody></table>
    <table width="80%" border="0" align="center" cellpadding="5" cellspacing="0" class="tb-bg">
      <tbody><tr> 
        <td><form action="" method="post" name="form1" id="form1">
            <p align="center" class="title2"><font color="#FF0000"></font></p>
            <table width="80%" border="0" align="center" cellpadding="2" cellspacing="2">
              <tbody><tr> 
                <td colspan="6" nowrap="" class="normal"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
                    <tbody><tr> 
                      <td width="50%"><hr></td>
                      <td nowrap=""><div align="center"> 
                          <p class="title3">General data</p>
                        </div></td>
                      <td width="50%"><hr></td>
                    </tr>
                  </tbody></table></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">Enable:</div></td>
                <td colspan="4" class="normal"><input name="enablemanager" type="checkbox" id="enablemanager" value="1" checked=""></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right"><font color="#FF0000">*</font> 
                    Manager name: </div></td>
                <td colspan="4" class="normal"><input name="managername" type="text" class="normal" id="managername" value="" size="32" maxlength="32">
                  (4-32 characters)</td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right"><font color="#FF0000">*</font> 
                    Password</div></td>
                <td colspan="4" class="normal"><input name="password1" type="password" class="normal" id="password2" value="" size="18" maxlength="32">
                  (4-32 characters)</td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right"><font color="#FF0000">*</font> 
                    Confirm password:</div></td>
                <td colspan="4" class="normal"><input name="password2" type="password" class="normal" id="password2" value="" size="18" maxlength="32">
                  (4-32 characters)</td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">First name:</div></td>
                <td colspan="4" class="normal"><input name="firstname" type="text" class="normal" id="realname3" value="" size="50" maxlength="50"></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">Last (family) name:</div></td>
                <td colspan="4" class="normal"><input name="lastname" type="text" class="normal" id="realname3" value="" size="50" maxlength="50"></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">Company name:</div></td>
                <td colspan="4" class="normal"><input name="company" type="text" class="normal" id="company" value="" maxlength="50" size="50" {en_company}=""></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">Address:</div></td>
                <td colspan="4" class="normal"><input name="address" type="text" class="normal" id="address3" value="" size="50" maxlength="50"></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">City:</div></td>
                <td colspan="4" class="normal"><input name="city" type="text" class="normal" id="city3" value="" size="15" maxlength="15"></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">ZIP:</div></td>
                <td colspan="4" class="normal"><input name="zip" type="text" class="normal" id="zip3" value="" size="8" maxlength="8"></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">Country:</div></td>
                <td colspan="4" class="normal"><strong> 
                  <select name="country" class="normal" id="country" {en_country}=""> <option selected="" value=""></option><option value="Retail">Retail</option><option value="Retail-FOC">Retail-FOC</option><option value="Office-FOC">Office-FOC</option><option value="Retail-VIP">Retail-VIP</option><option value="CFB">CFB</option><option value="CFB-FOC">CFB-FOC</option><option value="CFB-VIP">CFB-VIP</option><option value="Wifi-Haat">Wifi-Haat</option><option value="LISP">LISP</option><option value="Partner">Partner</option><option value="SVP">SVP</option>
                              
                           
                  </select>
                  </strong></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">State:</div></td>
                <td colspan="4" class="normal"><select name="state" class="normal" id="state" {en_state}=""> <option selected="" value=""></option><option value="Active">Active</option><option value="Discontinue">Discontinue</option>
                               
                              
                             
                  </select></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">Phone number:</div></td>
                <td colspan="4" class="normal"><input name="phone" type="text" class="normal" id="phone3" value="" size="15" maxlength="15"></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">Mobile number:</div></td>
                <td colspan="4" class="normal"><input name="mobile" type="text" class="normal" id="phone3" value="" size="15" maxlength="15"></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">Email:</div></td>
                <td colspan="4" class="normal"><input name="email" type="text" class="normal" id="email" value="" maxlength="50" size="50" {en_email}=""></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">VAT ID:</div></td>
                <td colspan="4" class="normal"><input name="vatid" type="text" class="normal" id="vatid" value="" maxlength="40" size="40" {en_taxid}=""></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">Language:</div></td>
                <td colspan="4" class="normal"><strong> 
                  <select name="lang" class="normal" id="lang"> <option value="English">English</option>
                  </select>
                  </strong></td>
              </tr>
              <tr> 
                <td colspan="2" nowrap="" class="normal"><div align="right">Comment:</div></td>
                <td colspan="4" class="normal"><input name="comment" type="text" class="normal" id="comment3" value="" size="50" maxlength="200"></td>
              </tr>
              <tr> 
                <td colspan="6" nowrap="" class="title3"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
                    <tbody><tr> 
                      <td>&nbsp;</td>
                      <td nowrap="">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td width="50%"><hr></td>
                      <td nowrap=""><div align="center"> 
                          <p class="title3">Permissions</p>
                        </div></td>
                      <td width="50%"><hr></td>
                    </tr>
                  </tbody></table></td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right">List users:</div></td>
                <td nowrap="" class="normal"><input name="perm_listusers" type="checkbox" id="perm_listusers" value="1"></td>
                <td nowrap="" class="normal"><div align="right">List managers:</div></td>
                <td nowrap="" class="normal"><input name="perm_listmanagers" type="checkbox" id="perm_listmanagers" value="1"></td>
                <td nowrap="" class="normal"><div align="right">List services:</div></td>
                <td nowrap="" class="normal"><input name="perm_listservices" type="checkbox" id="perm_listservices" value="1"></td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right">Register users:</div></td>
                <td nowrap="" class="normal"><input name="perm_createusers" type="checkbox" id="perm_createusers" value="1"></td>
                <td nowrap="" class="normal"><div align="right">Register managers:</div></td>
                <td nowrap="" class="normal"><input name="perm_createmanagers" type="checkbox" id="perm_createmanagers" value="1"></td>
                <td nowrap="" class="normal"><div align="right">Register services:</div></td>
                <td nowrap="" class="normal"><input name="perm_createservices" type="checkbox" id="perm_createservices" value="1"></td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right">Edit users:</div></td>
                <td nowrap="" class="normal"><input name="perm_editusers" type="checkbox" id="perm_editusers" value="1"></td>
                <td nowrap="" class="normal"><div align="right">Edit managers:</div></td>
                <td nowrap="" class="normal"><input name="perm_editmanagers" type="checkbox" id="perm_editmanagers" value="1"></td>
                <td nowrap="" class="normal"><div align="right">Edit services:</div></td>
                <td nowrap="" class="normal"><input name="perm_editservices" type="checkbox" id="perm_editservices" value="1"></td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right">Edit privileged user data:</div></td>
                <td nowrap="" class="normal"><input name="perm_edituserspriv" type="checkbox" id="perm_edituserspriv" value="1"></td>
                <td nowrap="" class="normal"><div align="right">Delete managers:</div></td>
                <td nowrap="" class="normal"><input name="perm_deletemanagers" type="checkbox" id="perm_deletemanagers" value="1"></td>
                <td nowrap="" class="normal"><div align="right">Delete services:</div></td>
                <td nowrap="" class="normal"><input name="perm_deleteservices" type="checkbox" id="perm_deleteservices" value="1"></td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right">Delete users:</div></td>
                <td nowrap="" class="normal"><input name="perm_deleteusers" type="checkbox" id="perm_deleteusers" value="1"></td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
              </tr>
              <tr> 
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right">Billing functions:</div></td>
                <td nowrap="" class="normal"><input name="perm_addcredits" type="checkbox" id="perm_addcredits" value="1"> 
                </td>
                <td nowrap="" class="normal"><div align="right">Access invoices:</div></td>
                <td nowrap="" class="normal"> <input name="perm_listinvoices" type="checkbox" id="perm_listinvoices" value="1"></td>
                <td nowrap="" class="normal"><div align="right">Access all users:</div></td>
                <td nowrap="" class="normal"><input name="perm_allusers" type="checkbox" id="perm_allusers" value="1"></td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right">Allow negative balance:</div></td>
                <td nowrap="" class="normal"> <input name="perm_negbalance" type="checkbox" id="perm_negbalance" value="1"></td>
                <td nowrap="" class="normal"><div align="right">Access all invoices:</div></td>
                <td nowrap="" class="normal"><input name="perm_listallinvoices" type="checkbox" id="perm_listallinvoices" value="1"></td>
                <td nowrap="" class="normal"><div align="right">List online users:</div></td>
                <td nowrap="" class="normal"><input name="perm_listonlineusers" type="checkbox" id="perm_listonlineusers" value="1"></td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right">Allow discount prices:</div></td>
                <td nowrap="" class="normal"><input name="perm_allowdiscount" type="checkbox" id="perm_allowdiscount" value="1"></td>
                <td nowrap="" class="normal"><div align="right">Accounting summary:</div></td>
                <td nowrap="" class="normal"><input name="perm_showinvtotals" type="checkbox" id="perm_showinvtotals" value="1"></td>
                <td nowrap="" class="normal"><div align="right">Disconnect users:</div></td>
                <td nowrap="" class="normal"><input name="perm_logout" type="checkbox" id="perm_logout" value="1"></td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right"> Enable canceling invoices:</div></td>
                <td nowrap="" class="normal"><input name="perm_enwriteoff" type="checkbox" id="perm_enwriteoff" value="1"></td>
                <td nowrap="" class="normal"><div align="right">Edit invoices:</div></td>
                <td nowrap="" class="normal"><input name="perm_editinvoice" type="checkbox" id="perm_editinvoice" value="1"></td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
              </tr>
              <tr> 
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right"> Card system &amp; IAS:</div></td>
                <td nowrap="" class="normal"><input name="perm_cardsys" type="checkbox" id="perm_cardsys" value="1"></td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right"> Connection report:</div></td>
                <td nowrap="" class="normal"><input name="perm_cts" type="checkbox" id="perm_cts" value="1"></td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right">Overall traffic report:</div></td>
                <td nowrap="" class="normal"><input name="perm_trafficreport" type="checkbox" id="perm_trafficreport" value="1"></td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
              </tr>
              <tr> 
                <td nowrap="" class="normal"><div align="right">Maintain APs:</div></td>
                <td nowrap="" class="normal"><input name="perm_accessap" type="checkbox" id="perm_accessap" value="1"></td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
                <td nowrap="" class="normal">&nbsp;</td>
              </tr>
            </tbody></table>
            <p align="center"> 
              <input name="checkall" type="button" class="normal" id="checkall" value="Check all" onclick="checkAllCheckboxes(true)">
              <input name="clearall" type="button" class="normal" id="clearall" value="Clear all" onclick="checkAllCheckboxes(false)">
            </p>
            <p align="center" class="normal"> <font color="#FF0000">*</font> Fields are mandatory!</p>
            <p align="center" class="normal"> 
              <input type="submit" name="Submit" value="Add manager">
              <script type="text/javascript"><!--
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
    //--> </script>
            </p>
          </form></td>
      </tr>
    </tbody></table>
     </td>
            </tr>
          </tbody></table>
    </body>
</html>