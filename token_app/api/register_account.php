<?php
require("../db.inc.php");
require("account.php");
//error_reporting(E_ALL);
header("Content-Type: application/json");

function fill_zero($number, $target) {
	$str_num = "" . $number;
	
	$len = strlen($str_num);
	$num_zero = $target - $len;
	
	$result = "";
	
	for ($i = 0; $i < $num_zero; $i++) {	
		$result .= "0";
	}
	
	return $result . $number;
}

$account_name = trim(htmlspecialchars($_GET["account_name"]));
$account_type = trim(htmlspecialchars($_GET["account_type"]));
$remarks = trim(htmlspecialchars($_GET["remarks"]));
$realm_id = trim(htmlspecialchars($_GET["realm_id"]));
$email_account = trim(htmlspecialchars($_GET["email_account"]));


if (is_duplicate($account_name, $realm_id, $conn)) {
	$duplicate = "Account name is already existed.";
	$warning = ["Error" => $duplicate, "result" => "Failure"];
	echo json_encode($warning);
	exit();
}

$output = ["result" => "Error2"];

// generate new ID 
$sql = "SELECT account_id FROM account ORDER BY account_id ";
$result = $conn->query($sql);

$id = "";

if ($result->num_rows > 0) {
		
	while($row = $result->fetch_assoc()) {
    	$id = $row["account_id"];
  	}
	
	$id = substr($id,3);
	$num = intval($id);
	$num += 1;
	
	$id = "ACC" . fill_zero(intval($num), 11);
	 
} else {
	$id = "ACC00000000001";
}

$output = ["id" => $id, "result" => "Error3"];

$sql2 = "INSERT INTO account (account_id,account_name,account_type,remarks,realm_id,email_account, ip_address) VALUES (?,?,?,?,?,?,?);";


$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param('sssssss', $id, $account_name, $account_type, $remarks, $realm_id, $email_account, $_SERVER['REMOTE_ADDR']);

if ($stmt2->execute()) {
	$output = ["id" => $id, "result" => "Success"];
} else {
	$output = ["result" => "Error"];
}

$stmt2->close();
echo json_encode($output);


?>