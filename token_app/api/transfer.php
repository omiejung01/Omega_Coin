<?php
require("../db.inc.php");
require("account.php");
//error_reporting(E_ALL);
header("Content-Type: application/json");

/*
function is_existed($acc_id, $re_id, $conn3) {
	
	$sql3 = "SELECT account_id FROM account WHERE account_id LIKE ? AND realm_id LIKE ? AND void = 0";
	$found = false; 

	if ($stmt3 = $conn3->prepare($sql3)) {
		$stmt3->bind_param("ss", $acc_id, $re_id);
		$stmt3->execute();
		if ($result3 = $stmt3->get_result()) {
			if ($result3->num_rows > 0) {
				$found = true;
			}
		}
		$stmt3->close();
	} else {
		echo "Error preparing statement: " . $conn3->error;
	}
	return $found;
}


function account_balance($acc_id, $re_id, $conn3,&$account_name,&$account_type) {
	$sql3 = "SELECT to_account, amount FROM transfer WHERE to_account LIKE ? AND realm_id LIKE ? AND void = 0";
	$to_amount = 0;

	if ($stmt3 = $conn3->prepare($sql3)) {
		$stmt3->bind_param("ss", $acc_id, $re_id);
		$stmt3->execute();
		$result3 = $stmt3->get_result();
		while ($row3 = $result3->fetch_assoc()) {
			//echo "To Account: " . $row['to_account'] . ", Amount: " . $row['amount'] . "<br>";
			$to_amount += $row3["amount"];
		}
		$stmt3->close();
	}
	
	$sql4 = "SELECT from_account, amount FROM transfer WHERE from_account LIKE ? AND realm_id LIKE ? AND void = 0";
	$from_amount = 0;
	if ($stmt4 = $conn3->prepare($sql4)) {
		$stmt4->bind_param("ss", $acc_id, $re_id);
		$stmt4->execute();
		$result4 = $stmt4->get_result();
		
		while ($row4 = $result4->fetch_assoc()) {
			//echo "To Account: " . $row['to_account'] . ", Amount: " . $row['amount'] . "<br>";
			$from_amount += $row4["amount"];
		}
		$stmt4->close();
	}
	
	//check account type
	$sql5 = "SELECT account_id, account_type, account_name FROM account WHERE account_id LIKE ? AND realm_id LIKE ? AND void = 0 ";
	if ($stmt5 = $conn3->prepare($sql5)) {
		$stmt5->bind_param("ss", $acc_id, $re_id);
		$stmt5->execute();
		$result5 = $stmt5->get_result();
		
		while ($row5 = $result5->fetch_assoc()) {
			$account_type= $row5["account_type"];
			$account_name= $row5["account_name"];			
		}
		$stmt5->close();	
	}
	
	$balance = 0;
	
	if ($account_type == "Assets") {
		$balance = $to_amount - $from_amount;
	} else {
		$balance = $from_amount - $to_amount;
	}
	
	return $balance;
}
*/

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

