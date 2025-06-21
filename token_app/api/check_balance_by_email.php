<?php
require("../db.inc.php");
require("account.php");
//error_reporting(E_ALL);
header("Content-Type: application/json");

$email_account = htmlspecialchars($_GET["email_account"]);
$realm_id = trim(htmlspecialchars($_GET["realm_id"]));


$account_name = "";
$account_type = "";
$account_remarks = "";

//$balance = account_balance($account_id, $conn, $account_name, $account_type);

$output = ["result" => "Error, No account"];
$account_id  = get_account_id($email_account, $realm_id, $conn);

if (is_existed($account_id, $realm_id, $conn)) {
	
	
	$balance = account_balance($account_id,$realm_id, $conn, $account_name, $account_type, $account_remarks);
	$output = ["realm_id" => $realm_id ,"account_id" => $account_id,"account_name" =>$account_name, "account_type" => $account_type, "account_remarks"=> $account_remarks,"balance" => $balance];
	
}

echo json_encode($output);

?>

