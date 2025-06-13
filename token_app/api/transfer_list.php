<?php
require("../db.inc.php");
//error_reporting(E_ALL);
header("Content-Type: application/json");

$output = ["result" => "Lady Ningguang"];

$account_id = trim(htmlspecialchars($_GET["account_id"]));
$realm_id = trim(htmlspecialchars($_GET["realm_id"]));

$to_date = trim(htmlspecialchars($_GET["to_date"]));
$from_date = trim(htmlspecialchars($_GET["from_date"]));

$sql3 = "SELECT transfer_id,  account.account_name debit ,  a2.account_name credit, amount, transfer.remarks " .
		"FROM transfer LEFT JOIN account on transfer.to_account = account.account_id " . 
		"LEFT JOIN account a2 ON transfer.from_account = a2.account_id " .
		"WHERE ((transfer.to_account LIKE ?) OR (transfer.from_account LIKE ?)) AND realm_id LIKE ? AND void = 0 " .
		"ORDER BY transfer_id ";

$data = array(); 		

if ($stmt3 = $conn->prepare($sql3)) {
	$stmt3->bind_param("sss", $account_id, $account_id, $realm_id);
	$stmt3->execute();
	$result3 = $stmt3->get_result();
	
	while ($row3 = $result3->fetch_assoc()) {
		//echo "To Account: " . $row['to_account'] . ", Amount: " . $row['amount'] . "<br>";
		//$to_amount += $row3["amount"];
		$data[] = $row3;
	}
	
	$output = ["result" => "Success", "ledger" => $data];
	$stmt3->close();
}

/*

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
*/

echo json_encode($output);

?>

