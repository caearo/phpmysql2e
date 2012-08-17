<?php # Script 7.0 - mysql_connect.php

// This file contains the database access information.
// This file also establishes a connection to MySQL and selects the databse.

// Set the database access information as constants.
define('DB_USER', 'root');
define('DB_PASSWORD', '123456');
define('DB_HOST', '192.168.1.105:8000');
define('DB_NAME', '');

// Make the connection.
$dbc = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL:' . mysql_error());

// Select the database
@mysql_select_db(DB_NAME) OR die('Could not select the database:' . mysql_error());
?>