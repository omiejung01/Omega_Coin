<?php
require("../db.inc.php");
require("account.php");
error_reporting(E_ALL);
header("Content-Type: application/json");

$realm_id = trim(htmlspecialchars($_GET["realm_id"]));
$give_away_account_id = "ACC00000000003"; // need to input this account

//give_away($give_away_account_id, $realm_id, $conn);

$output = check_last_giveaway($realm_id, $conn);

echo json_encode($output);
//echo "editing";
?>

