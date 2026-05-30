# Omega_Coin
This is for in-app money. Omega coin project. You can implement your own wallet application. Front-78

# db.inc.php
Please put this code in your chatapp/db.inc.php

```
<?php

$servername = "localhost"; // Or your host name (e.g., "db.example.com")
$username = "<your username>";
$password = "<your password>";
$dbname = "<your database name>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>
```

# Database
Account table

Transfer table
to_account
from_account


Realm table
realm_id
name
key 
email_account


# todo
Profile picture with media server, and upload panel to media server. Create group chat only one-to-one


0016A00000067701011201150105538091073030204250403041.50

0016A0000006770101120115010553809107303020425040307MAY2026

00020101021230550016A00000067701011201150105538091073030204250403041.5053037645802TH630485FA

00020101021230580016A0000006770101120115010553809107303020425040307MAY2026530376454041.505802TH63048836

00020101021230550016A00000067701011201150105538091073030204250403041.50530376454041.505802TH6304477D




