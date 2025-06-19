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

function is_duplicate($realm_name, $conn3) {
	$sql3 = "SELECT realm_id FROM realm WHERE realm_name LIKE ? AND void = 0 ";
	//print($sql3);
	//$result3 = $conn3->query($sql3);
	
	$stmt3 = $conn3->prepare($sql3);
	$stmt3->bind_param('s', $realm_name);
	$stmt3->execute();
    $result3 = $stmt3->get_result();

	$found = false;
	if ($result3->num_rows > 0) {
		$found = true;
	}
	$stmt3->close();
		
	return $found;
}

$realm_name = trim(htmlspecialchars($_GET["realm_name"]));
$email_account = trim(htmlspecialchars($_GET["email_account"]));

if (is_duplicate($realm_name, $conn)) {
	$duplicate = "Realm name is already existed.";
	$warning = ["Error" => $duplicate, "result" => "Failure"];
	echo json_encode($warning);
	exit();
}

$output = ["result" => "Error2"];

// generate new ID 
$sql = "SELECT realm_id FROM realm ORDER BY realm_id ";
$result = $conn->query($sql);

$id = "";

if ($result->num_rows > 0) {
		
	while($row = $result->fetch_assoc()) {
    	$id = $row["realm_id"];
  	}
	
	$id = substr($id,5);
	$num = intval($id);
	$num += 1;
	
	$id = "REALM" . fill_zero(intval($num), 8);
	 
} else {
	$id = "REALM00000001";
}

$output = ["id" => $id, "result" => "Error3"];

$str_keygen = $id . realm_name;
$key = hash('sha256', $str_keygen);

$sql2 = "INSERT INTO realm (realm_id,realm_name,realm_key,email_account, ip_address) VALUES (?,?,?,?,?);";

$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param('sssss', $id, $realm_name, $key, $email_account, $_SERVER['REMOTE_ADDR']);

if ($stmt2->execute()) {

	//echo $id;
	//if ($conn->query($sql2) === TRUE) {
	$output = ["id" => $id,"email_account" => $email_account,"realm_name" => $realm_name,"realm_key" => $key, "result" => "Success"];
} else {
	$output = ["result" => "Error"];
}

$stmt2->close();
echo json_encode($output);


?>