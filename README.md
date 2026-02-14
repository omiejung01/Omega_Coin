# Omega_Coin
This is for in-app money. Omega coin project. You can implement your own wallet application. Front-03

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
