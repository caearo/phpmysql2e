<?php # Script 7.4 - view_users.php
// This script retrieves all the records from the users table.

$page_title = 'View the Current Users';
include('./includes/header.html');

// Page header.
echo '<h1 id="naminhead">Registered Users</h1>';

require_once('./mysql_connect.php'); // Connect to the db.

// Make the query.
$query = "SELECT CONCAT(last_name, '.', first_name) AS name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr FROM users ORDER BY registration_date ASC";
$result = @mysql_query($query); // Run the query.

if ($result) {
	
	// Table header.
	echo '
	<table align="center" cellspacing="0" cellpadding="5">
	<tr>
		<td align="left"><b>Name</b></td>
		<td align="left"><b>Date Registered</b></td>
	</tr>
	';

	//fetch and print all the records.
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo '<tr><td align="left">' . $row['name'] . '</td><td align="left">' . $row['dr'] . '</td></tr>';
	}

	echo '</table>';

	mysql_free_result($result); // Free up the resources.

} else {
	echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>'; // Public message.
	echo '<p>' . mysql_error() . '<br /><br />Query:' . $query. '</p>'; //Debugging message.
}

mysql_close(); // Close the database connection.

include('./includes/footer.html');
?>
