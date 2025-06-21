<?php
require("../db.inc.php");
require("account.php");
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
		"WHERE ((transfer.to_account LIKE ?) OR (transfer.from_account LIKE ?)) AND transfer.realm_id LIKE ? AND transfer.void = 0 " .
		"ORDER BY transfer.transfer_id ";

$data = array(); 		
$account_name = '';
$account_type = '';
$account_remarks = '';

if ($stmt3 = $conn->prepare($sql3)) {
	$stmt3->bind_param("sss", $account_id, $account_id, $realm_id);
	$stmt3->execute();
	$result3 = $stmt3->get_result();
	
	while ($row3 = $result3->fetch_assoc()) {
		//echo "To Account: " . $row['to_account'] . ", Amount: " . $row['amount'] . "<br>";
		//$to_amount += $row3["amount"];
		$data[] = $row3;
	}
	
	$balance = account_balance($account_id, $realm_id, $conn, $account_name, $account_type, $account_remarks);
	
	$output = ["result" => "Success", "account_name" => $account_name, 
				"account_type" => $account_type, "ledger" => $data, "balance" => $balance ];
	$stmt3->close();
}

echo json_encode($output);

?>

