<?php
require("../db.inc.php");
require("account.php");
//error_reporting(E_ALL);
header("Content-Type: application/json");

$from_account = trim(htmlspecialchars($_GET["from_account"]));
$to_account  = trim(htmlspecialchars($_GET["to_account"]));
$amount = trim(htmlspecialchars($_GET["amount"]));
$remarks = trim(htmlspecialchars($_GET["remarks"]));
$realm_id = trim(htmlspecialchars($_GET["realm_id"]));

$account_name = '';
$account_type = '';

$output = ["result" => "Error, No account"];
//
if (is_existed($from_account, $realm_id, $conn) && is_existed($to_account, $realm_id, $conn)) {
	
	
	//$output = ["account_id" => $account_id,"account_name" =>$account_name, "account_type" => $account_type,"balance" => $balance];
	
	// generate new ID 
	$sql = "SELECT MAX(transfer_id) AS max_id FROM transfer ";
	$stmt = $conn->query($sql);
	$id = 0;
	
	if ($stmt && $stmt->num_rows > 0) {
		$row = $stmt->fetch_assoc();
		if ($row['max_id'] !== null) { 
			$id = $row['max_id'];
		}
		$stmt->free();
	} else {
		
		$output = ["result" => "Error, Cannot transfer"];
	}
	

	$id += 1;	
	$stmt->close();
	
	$allowed = false;
	$output = ["result" => "Not allowed", "from_account" => $from_account , "remarks" => $remarks];

	if ((strcmp($remarks,"Initial")==0) && (strcmp($from_account,"ACC00000000001")==0)) {
		$allowed = true;
	} else if ((strcmp(substr($remarks,0,7),"Deposit")==0) && (strcmp($to_account,"ACC00000000002")==0)) {
		$allowed = true;
	} else if ((strcmp(substr($remarks,0,8),"Purchase")==0) || (strcmp(substr($remarks,0,8),"Withdraw")==0)) {
		$balance = account_balance($to_account, $realm_id, $conn, $account_name, $account_type);
		// Purchase transaction: to_account => buyer, from_Account => seller		
		if ($balance < $amount) {
			$output = ["result" => "Not enough balance"];
		} else {
			$allowed = true;
		}
	} else if (strcmp(substr($remarks,0,9),"Give away")==0) {
		$output = ["result" => "Cannot give away"];
		
		$to_account_type = '';
		$from_account_type = '';
		
		account_balance($to_account,$realm_id, $conn, $account_name, $to_account_type);
		account_balance($from_account,$realm_id, $conn, $account_name, $from_account_type);
		
		if ((strcmp($to_account_type,'Expenses')==0)&&(strcmp($from_account_type,'Liabilities')==0)) {		
			$allowed = true;		
		}
	}
	
	if ($allowed) {
		$sql2 = "INSERT INTO transfer (transfer_id, from_account, to_account, amount, remarks, realm_id, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?)";

		$stmt = $conn->prepare($sql2);
		if ($stmt === FALSE) {
			$output = ["result" =>  ("Error 1 " . $conn->error )];
		} else {
			$stmt->bind_param("ississs", $id, $from_account, $to_account, $amount, $remarks, $realm_id, $_SERVER['REMOTE_ADDR']);
			if ($stmt->execute()) {
				$output = ["transfer_id" => $id, "remarks" => $remarks, "result" => "Success"];
			} else {
				$output = ["result" =>  ("Error 2 " . $conn->error) , "id" => $id];
			}
			$stmt->close();
		}
	}
}

echo json_encode($output);

?>

