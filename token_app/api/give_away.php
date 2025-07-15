<?php
require("../db.inc.php");
require("account.php");
error_reporting(E_ALL);
header("Content-Type: application/json");

$realm_id = trim(htmlspecialchars($_GET["realm_id"]));
$give_away_account_id = "ACC00000000003"; // need to input this account

//give_away($give_away_account_id, $realm_id, $conn);

$last_giveaway = check_last_giveaway($realm_id, $conn);

$last_time = str_replace("Give away-", "", $last_giveaway);

$now = date('YmdHis');

// 9 minutes 11:51:00 - 12:00:00 = 900
$seconds = floatval($now) - floatval($last_time);

if ($seconds > 899) {
	give_away($give_away_account_id, $realm_id, $conn);	
} else {
	$output = ["interval seconds" => $seconds];
	echo json_encode($output);
}

?>

