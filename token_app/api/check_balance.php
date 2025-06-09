<?php
require("../db.inc.php");
error_reporting(E_ALL);
header("Content-Type: application/json");

function is_existed($acc_id, $conn3) {
	
	$sql3 = "SELECT account_id FROM account WHERE account_id LIKE ? AND void = 0";
	$found = false; 

	if ($stmt3 = $conn3->prepare($sql3)) {
		$stmt3->bind_param("s", $acc_id);
		$stmt3->execute();
		$result3 = $stmt3->get_result();
		if ($result3->num_rows > 0) {
			$found = true;
		}
		$stmt3->close();
	} else {
		echo "Error preparing statement: " . $conn3->error;
	}
	return $found;
}


function account_balance($acc_id, $conn3,&$account_name,&$account_type) {
	$sql3 = "SELECT to_account, amount FROM transfer WHERE to_account LIKE ? AND void = 0";
	$to_amount = 0;

	if ($stmt3 = $conn3->prepare($sql3)) {
		$stmt3->bind_param("s", $acc_id);
		$stmt3->execute();
		$result3 = $stmt3->get_result();
		while ($row3 = $result3->fetch_assoc()) {
			//echo "To Account: " . $row['to_account'] . ", Amount: " . $row['amount'] . "<br>";
			$to_amount += $row3["amount"];
		}
		$stmt3->close();
	}
	
	$sql4 = "SELECT from_account, amount FROM transfer WHERE from_account LIKE ? AND void = 0";
	$from_amount = 0;
	if ($stmt4 = $conn3->prepare($sql4)) {
		$stmt4->bind_param("s", $acc_id);
		$stmt4->execute();
		$result4 = $stmt4->get_result();
		
		while ($row4 = $result4->fetch_assoc()) {
			//echo "To Account: " . $row['to_account'] . ", Amount: " . $row['amount'] . "<br>";
			$from_amount += $row4["amount"];
		}
		$stmt4->close();
	}
	
	//check account type
	$sql5 = "SELECT account_id, account_type, account_name FROM account WHERE account_id LIKE ? AND void = 0 ";
	if ($stmt5 = $conn3->prepare($sql5)) {
		$stmt5->bind_param("s", $acc_id);
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


//$output = ["result" => "Error2"];

$account_id = htmlspecialchars($_GET["account_id"]);
$account_name = "";
$account_type = "";

//$balance = account_balance($account_id, $conn, $account_name, $account_type);

$output = ["result" => "Error, No account"];

if (is_existed($account_id, $conn)) {
	$balance = account_balance($account_id, $conn, $account_name, $account_type);
	$output = ["account_id" => $account_id,"account_name" =>$account_name, "account_type" => $account_type,"balance" => $balance];
	
}

echo json_encode($output);

//echo json_encode(["message" => "User added successfully"]);

//$data = "Rex Lapis"; 
//$key = "vagomundo";

// Calculate the SHA256 hash
//$hash = hash_hmac('sha256', $data,$key);

//echo "SHA256 hash of '$data': " . $hash . "\n";	

?>

