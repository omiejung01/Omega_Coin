<?php
require("../db.inc.php");
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

// Check duplication

function is_duplicate($acc_name, $conn3) {
	$sql3 = "SELECT account_id FROM account WHERE account_name LIKE '" . $acc_name . "' AND void = 0 ";
	//print($sql3);
	$result3 = $conn3->query($sql3);
	
	$found = false;
	if ($result3->num_rows > 0) {
		$found = true;
	} 
	return $found;
}

$account_name = htmlspecialchars($_GET["account_name"]);
$account_type = htmlspecialchars($_GET["account_type"]);
$remarks = htmlspecialchars($_GET["remarks"]);


if (is_duplicate($account_name, $conn)) {
	$duplicate = "Account name is already existed.";
	$warning = ["Error" => $duplicate, "result" => "Failure"];
	echo json_encode($warning);
	exit();
}


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

$sql2 = "INSERT INTO account (account_id,account_name,account_type,remarks) VALUES ('$id','$account_name','$account_type','$remarks');";
//echo $id;
if ($conn->query($sql2) === TRUE) {
  $result = ["id" => $id, "result" => "Success"];
} else {
  $result = "Error: " . $sql2 . "<br>" . $conn->error;
  //$result = ["result" => "Not success"];
  
}

echo json_encode($result);




//echo json_encode(["message" => "User added successfully"]);

//$data = "Rex Lapis"; 
//$key = "vagomundo";

// Calculate the SHA256 hash
//$hash = hash_hmac('sha256', $data,$key);

//echo "SHA256 hash of '$data': " . $hash . "\n";	



?>