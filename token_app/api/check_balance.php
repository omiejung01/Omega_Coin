<?php
require("../db.inc.php");
error_reporting(E_ALL);
header("Content-Type: application/json");

/*
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
*/


// Check duplication
function is_existed($acc_id, $conn3) {
	$sql3 = "SELECT account_id FROM account WHERE account_id LIKE '" . $acc_id . "' AND void = 0 ";
	//print($sql3);
	$result3 = $conn3->query($sql3);
	
	$found = false;
	if ($result3->num_rows > 0) {
		$found = true;
	} 
	return $found;
}

function account_balance($acc_id, $conn3,&$account_name,&$account_type) {
	$sql3 = "SELECT to_account, amount FROM transfer WHERE to_account LIKE '" . $acc_id . "' AND void = 0 ";
	//print($sql3);
	
	$result3 = $conn3->query($sql3);
	$to_amount = 0;
	
	while($row = $result3->fetch_assoc()) {
    	$to_amount += $row["amount"];
  	}
	
	$sql4 = "SELECT from_account, amount FROM transfer WHERE from_account LIKE '" . $acc_id . "' AND void = 0 ";
	//print($sql3);
	$result4 = $conn3->query($sql4);
	$from_amount = 0;
	
	while($row = $result4->fetch_assoc()) {
    	$from_amount += $row["amount"];
  	}
	
	//check account type
	//$account_type = "";
	$sql5 = "SELECT account_id, account_type, account_name FROM account WHERE account_id LIKE '" . $acc_id . "' AND void = 0 ";
	//print($sql3);
	$result5 = $conn3->query($sql5);
	
	while($row = $result5->fetch_assoc()) {
    	$account_type= $row["account_type"];
    	$account_name= $row["account_name"];
    	
  	}
		
	$balance = 0;
	
	if ($account_type == "Asset") {
		$balance = $to_amount - $from_amount;
	} else {
		$balance = $from_amount - $to_amount;
	}
	
	return $balance;
}

$account_id = htmlspecialchars($_GET["account_id"]);
$account_name = "";
$account_type = "";

$balance = account_balance($account_id, $conn, $account_name, $account_type);

$result = "Error: No account";

if (is_existed($account_id, $conn)) {
	$result = ["account_id" => $account_id,"account_name" =>$account_name, "account_type" => $account_type,"balance" => $balance];
}

echo json_encode($result);

//echo json_encode(["message" => "User added successfully"]);

//$data = "Rex Lapis"; 
//$key = "vagomundo";

// Calculate the SHA256 hash
//$hash = hash_hmac('sha256', $data,$key);

//echo "SHA256 hash of '$data': " . $hash . "\n";	



?>

