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
	$sql3 = "SELECT account_id FROM account WHERE account_name LIKE ? AND void = 0 ";
	//print($sql3);
	//$result3 = $conn3->query($sql3);
	
	$stmt3 = $conn3->prepare($sql3);
	$stmt3->bind_param('s', $acc_name);
	$stmt3->execute();
    $result3 = $stmt3->get_result();

	$found = false;
	if ($result3->num_rows > 0) {
		$found = true;
	}
	$stmt3->close();
		
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

//$sql2 = "INSERT INTO account (account_id,account_name,account_type,remarks) VALUES ('$id','$account_name','$account_type','$remarks');";
$sql2 = "INSERT INTO account (account_id,account_name,account_type,remarks) VALUES (?,?,?,?);";


$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param('ssss', $id, $account_name, $account_type, $remarks);

if ($stmt2->execute()) {

	//echo $id;
	//if ($conn->query($sql2) === TRUE) {
	$output = ["id" => $id, "result" => "Success"];
} else {
	$output = ["result" => "Error"];
}

$stmt2->close();
echo json_encode($output);


?>