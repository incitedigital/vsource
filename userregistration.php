<?php header("Access-Control-Allow-Origin: *"); ?>
<?php

	require_once("connections.php");
	$fname =  $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$status = 'inactive';
	$password = $_POST['password'];
	$validation = $_POST['validation'];
	$registrationdate = date('Y-m-d');
	
	if ((isset($_POST["userreg"])) && ($_POST["userreg"] == "form1")) {
	
	$query = "SELECT * from tbl_user WHERE email = '$email'";
	mysql_select_db($database_dbc, $dbc);
	$result = mysql_query($query, $dbc) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($result);
	$totalRows_Recordset1 = mysql_num_rows($result);
	
	//if user is already registered send back 0 to app
	if ($totalRows_Recordset1 > 0) {
	
		echo 0;
	
	}
	
	else {
	
		$userreg = "INSERT INTO tbl_user (first_name, last_name, email, password, validation_code, status, registrationdate) values ('$fname','$lname','$email', '$password','$validation','$status', '$registrationdate')";
  mysql_select_db($database_dbc, $dbc);
$Result1 = mysql_query($userreg, $dbc) or die(mysql_error()); 
$id = mysql_insert_id();
echo $id;
$to = strip_tags($_POST['email']);
$subject = ' Your VSource Validation Code';
$headers = "From: noreply@vnamailbox.com \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body style="background-color:#eee;">';
$message .= '<table rules="all" width="650px" style="background-color:#fff; border-collapse: collapse;" align="center">';
$message .= '<tr><td colspan="2"><!--enter image here --></td></tr>';
$message .= '</table>';
$message .= '<table width="650px" style="background-color:#fff; border-collapse: collapse;" align="center" cellpadding="10">';
$message .= "<tr><td colspan=\"2\">Your VSource validation code. </td></tr>";
$message .= "<tr><td width='30%'><strong>Your Email:</strong> </td><td width='70%'>" . strip_tags($_POST['email']) . "</td></tr>";
$message .= "<tr><td><strong>Validation Code:</strong> </td><td>" . strip_tags($_POST['validation']) . "</td></tr>";
$message .= "</table>";
$message .= "</body></html>";
mail($to, $subject, $message, $headers); 



	}
	
	
	
	}
	
	
?>

