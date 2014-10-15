<?php require_once('localhost.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "registration")) {
  $insertSQL = sprintf("INSERT INTO User (FirstName, LastName, Email, UserName, Password) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['UserName'], "text"),
                       GetSQLValueString($_POST['Password'], "text"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($insertSQL, $localhost) or die(mysql_error());

 /*$insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));*/
}

mysql_select_db($database_localhost, $localhost);
$query_RegisterUsers = "SELECT * FROM User";
$RegisterUsers = mysql_query($query_RegisterUsers, $localhost) or die(mysql_error());
$row_RegisterUsers = mysql_fetch_assoc($RegisterUsers);
$totalRows_RegisterUsers = mysql_num_rows($RegisterUsers);

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Registration</title>
</head>

<body>
<h1>Registration</h1>
<form method="POST" action="<?php echo $editFormAction; ?>" name="registration">
<label> First Name: </label><br>
<input type="text" name="FirstName" required="required"><br>
<label> Last Name: </label><br>
<input type="text" name="LastName" required="required"><br>
<label> Email: </label><br>
<input type="email" name="Email" required="required"><br>
<label> UserName: </label><br>
<input name="UserName" type="text" required="required"><br>
<label> Password: </label><br>
<input name="Password" type="password" required="required"><br>

<input type="submit" value="Register">
<input type="hidden" name="MM_insert" value="registration">
</form>
</body>
</html>
<?php
mysql_free_result($RegisterUsers);
?>
