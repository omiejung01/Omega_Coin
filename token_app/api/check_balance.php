<?php
require("../db.inc.php");
require("account.php");
//error_reporting(E_ALL);
header("Content-Type: application/json");

$account_id = htmlspecialchars($_GET["account_id"]);
$realm_id = trim(htmlspecialchars($_GET["realm_id"]));


$account_name = "";
$account_type = "";
$account_remarks = "";

//$balance = account_balance($account_id, $conn, $account_name, $account_type);

$output = ["result" => "Error, No account"];

if (is_existed($account_id, $realm_id, $conn)) {
	$balance = account_balance($account_id,$realm_id, $conn, $account_type, $account_name, $remarks);
		
	$output = ["realm_id" => $realm_id ,"account_id" => $account_id,"account_name" =>$account_name, "account_type" => $account_type, "remarks" => $remarks, "balance" => $balance];
	
}

echo json_encode($output);

?>

