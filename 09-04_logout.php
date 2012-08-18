<?php # Script 9.4 - logout.php
// This page lets the user logout.

// If no cookie is present, redirect the user.
if (!isset($_COOKIE['user_id'])) {

	// Start defining the URL.
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	// Check for a trailing slash.
	if ((substr($url, -1) == '/') OR (substr($url, -1) == '\\') ) {
		$url = substr ($url, 0, -1); // Chop off the slash.
	}
	$url .= '/index.php'; // Add the page.
	header("Location: $url");
	exit(); // Quit the script.

} else { // Delete the cookies.
	setcookie ('first_name', '', time()-300, '/', '', 0);
	setcookie ('user_id', '', time()-300, '/', '', 0);
}

// Set the page title and include the HTML header.
$page_title = 'Logged Out!';
include ('./includes/header.html');

// Print a customized message.
echo "<h1>Logged Out!</h1>
<p>You are now logged out, {$_COOKIE['first_name']}!</p>
<p><br /><br /></p>";

include ('./includes/footer.html');
?>