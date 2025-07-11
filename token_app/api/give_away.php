<?php
class ActiveAccount {
	$account_id,
	$to_amount
	$from_amount
	
}

require("../db.inc.php");
require("account.php");
//error_reporting(E_ALL);
header("Content-Type: application/json");

$from_account = trim(htmlspecialchars($_GET["from_account"]));
$to_account  = trim(htmlspecialchars($_GET["to_account"]));
$amount = trim(htmlspecialchars($_GET["amount"]));
$remarks = trim(htmlspecialchars($_GET["remarks"]));
$realm_id = trim(htmlspecialchars($_GET["realm_id"]));

//$account_name = '';
//$account_type = '';
//$account_remarks = '';


//$output = ["result"];

// list of active account



//echo json_encode($output);
echo "editing";
?>

