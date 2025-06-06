<?php
require("../db.inc.php");
//error_reporting(E_ALL);
header("Content-Type: application/json");
/*
function account_balance($acc_id, $conn3) {

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
	
	
	$stmt3->close();
	
	return $to_amount - $from_amount;	
}
*/


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
	
	if ($account_type == "Asset") {
		$balance = $to_amount - $from_amount;
	} else {
		$balance = $from_amount - $to_amount;
	}
	
	return $balance;
}

$from_account = htmlspecialchars($_GET["from_account"]);
$to_account  = htmlspecialchars($_GET["to_account"]);
$amount = htmlspecialchars($_GET["amount"]);
$remarks = htmlspecialchars($_GET["remarks"]);

// did not use
$account_name = '';
$account_type = '';

// check balance
if (account_balance($from_account, $conn, $account_name, $account_type) < $amount) {
	$result = ["message" => "Balance is not enough", "result" => "Failure"];
} else {
	// generate new ID 
	$sql = "SELECT transfer_id FROM transfer ORDER BY transfer_id ";

	$result = $conn->query($sql);

	$id = "";

	if ($result->num_rows > 0) {
			
		while($row = $result->fetch_assoc()) {
			$id = $row["transfer_id"];
		}
		
		//$id = substr($id,2);
		
		$num = intval($id);
		$num += 1;
		
		$id = $num;
		 
	} else {

		$id = "1";
	}
	
	$allowed = false;
	$result = ["result" => "Not allowed"];
	
	if ((strcmp($remarks,"Initial")==0) && (strcmp($from_account,"ACC00000000001")==0)) {
		$allowed = true;
	} 
	
	if ($allowed) {
		$sql2 = "INSERT INTO transfer (transfer_id,from_account,to_account,amount,remarks) VALUES ('$id','$from_account','$to_account',$amount,'$remarks');";
		//echo $id;
		if ($conn->query($sql2) === TRUE) {
		  $result = ["id" => $id, "result" => "Success"];
		} else {
		  $result = "Error: " . $sql2 . "<br>" . $conn->error;
		  //$result = ["result" => "Not success"];
		}
	}
}

echo json_encode($result);

?>

