<?php # Script 7.4 - view_users.php
// This script retrieves all the records from the users table.

$page_tile = 'View the Current Users':
include('./includes/header.html');

// Page header.
echo '<h1 id="naminhead">Registered</h1>';

require_once('./mysql_connect.php'); // Connect to the db.

// Make the query.
$query = "SELECT CONCAT(last_name, '.', first_name) AS name, DATA_FORMAT(registration_date, '%M %d, %Y') AS dr FROM users ORDER BY registration_date ASC";
$result = @mysql_query($query); // Run the query.
?>
