<?php
require("../db.inc.php");
require("account.php");
error_reporting(E_ALL);
header("Content-Type: application/json");

class ThisAccount {
  public $account_id;
  public $total;
  public function __construct($account_id, $total) {
    $this->account_id = $account_id;
    $this->total = $total;
  }
}

class ThisAccount2 {
  public $account_id;
  public $account_type;
  public $remarks;
  public $to_amount;
  public $from_amount;
  public $balance;
  public function __construct($account_id, $account_type, $remarks, $to_amount, $from_amount, $balance) {
    $this->account_id = $account_id;
	$this->account_type = $account_type;
	$this->remarks = $remarks;	
	$this->to_amount = $to_amount;
	$this->from_amount = $from_amount;
    $this->balance = $balance;
  }
}

class ThisAccount3 {
  public $account_id;
  public $account_type;
  public $remarks;
  
  public function __construct($account_id, $account_type, $remarks) {
    $this->account_id = $account_id;
	$this->account_type = $account_type;
	$this->remarks = $remarks;	
  }
}

// Step. 1 list of active account
// Step. 2 List to_account sum
// Step. 3 List from_account sum
// Step. 4 Create balance table
// Step. 5 Only Balance < 200 ==> +1 token

$list_result = array();
$list_result2 = array();
$list_result3 = array();
$list_result4 = array();
	
$sql3 = "SELECT account_id, account_type, remarks FROM account WHERE void = 0 ORDER by account_id ";
$found = false; 

if ($stmt3 = $conn->prepare($sql3)) {
	$stmt3->execute();
	$result3 = $stmt3->get_result();
	while ($row3 = $result3->fetch_assoc()) {
		$list_result[] = new ThisAccount3($row3["account_id"], $row3["account_type"], $row3["remarks"]);
	}	
	$stmt3->close();
} else {
	echo "Error preparing statement: " . $conn3->error;
}
//return $result_account_id;

//foreach ($list_result as $x) {
//  echo "$x->account_id $x->account_type $x->remarks \n";
//}

$sql4 = "SELECT to_account, sum(amount) AS total FROM transfer WHERE transfer.void = 0 GROUP BY from_account ";
$found = false; 

if ($stmt4 = $conn->prepare($sql4)) {
	$stmt4->execute();
	$result4 = $stmt4->get_result();
	while ($row4 = $result4->fetch_assoc()) {
		//$list_result[] = $row4["from_account"];
		$list_result2[] = new ThisAccount($row4["to_account"],$row4["total"]);
	}	
	$stmt4->close();
} else {
	echo "Error preparing statement: " . $conn4->error;
}

//foreach ($list_result2 as $y) {
//  echo "$y->account_id " . "$y->total \n";
//}

$sql5 = "SELECT from_account, sum(amount) AS total FROM transfer WHERE transfer.void = 0 GROUP BY from_account ";
$found = false; 

if ($stmt5 = $conn->prepare($sql5)) {
	$stmt5->execute();
	$result5 = $stmt5->get_result();
	while ($row5 = $result5->fetch_assoc()) {
		//$list_result[] = $row4["from_account"];
		$list_result3[] = new ThisAccount($row5["from_account"],$row5["total"]);
	}	
	$stmt5->close();
} else {
	echo "Error preparing statement: " . $conn5->error;
}

//foreach ($list_result3 as $y) {
//  echo "$y->account_id " . "$y->total \n";
//}

// Step. 4
foreach ($list_result as $z) {
	//echo "account_id: $z";
	
	$to_amount = 0.0;
	foreach ($list_result2 as $a) {
		if (strcmp($z->account_id, $a->account_id) == 0) {
			$to_amount = $a->total;
		}
	}
	//echo "to_amount: $to_amount";

	$from_amount = 0.0;
	foreach ($list_result3 as $b) {
		if (strcmp($z->account_id, $b->account_id) == 0) {
			$from_amount = $b->total;
		}
	}	
	//echo "from_amount: $from_amount";

	$balance = $to_amount - $from_amount;	
	//echo "balance: $balance \n";

	$list_result4[] = new ThisAccount2($z->account_id,$z->account_type,$z->remarks, $to_amount, $from_amount, $balance);
}

foreach ($list_result4 as $c) {
  echo "$c->account_id $c->account_type $c->remarks $c->to_amount $c->from_amount $c->balance \n";
}


//echo json_encode($output);
echo "editing";
?>

