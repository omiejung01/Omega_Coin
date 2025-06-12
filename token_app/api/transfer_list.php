<?php
require("../db.inc.php");
//error_reporting(E_ALL);
header("Content-Type: application/json");

$output = ["result" => "Lady Ningguang"];



echo json_encode($output);

?>

