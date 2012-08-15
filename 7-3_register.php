<?php # Script 7.3 - register.php

$page_title = 'Register';
include ('./includes/header.html');

//check if the form has been submitted.
if (isset($_POST['submitted'])) {
	
	$errors = array(); // Initialize the error array.

	// Check for a first name.
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = trim($_POST['first_name']);
	}
	
	// Check for a last name.
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = trim($_POST['last_name']);
	}

	// Check for an email address.
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = trim($_POST['email']);
	}

	// Check for a password and match against the confirmed password.
	if (!empty($_POST['password1'])) {
		if ($_POST['password1'] != $_POST['password2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = trim($_POST['password1']);
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}

	if (empty($errors)) { // If everything is OK.

		// Register the user in the database.
		require_once('mysql_connect.php');

		// Make the query.
		$query = "INSERT INTO users (first_name, last_name, email, password, registration_date) VALUES ( '$fn', '$ln', '$e', SHA('$p'), NOW() )";
		$result = @mysql_query($query); // Run the query.
		if ($result) { // If it ran OK.

			// Send an email, if desired.

			// Print a message.
			echo '<h1 id="mainhead">Thank you!</h1>
			<p>You are now registered. In Chapter 9 you will actually be able to log in.</p>
			<p><br /></p>';
		} else { // If it did not run OK.
			echo '<h1 id="mainhead">System Error!</h1>
				<p class="error">You could not be registered due to a system error. We apologize for any
				inconvenience.</p>'; // Public message.
			echo '<p>' . mysql_error() . '<br /><br />Query:' . $query . '</p>'; // Debug message.
			include ( './includes/footer.html');
			exit();
		}

		mysql_close(); // Close the database connection.

		

	} else {

		echo '<h1 id="mainhead">Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) {	// Print each error.
			echo ". $msg<br />\n";
		}
		echo "</p><p>Please go back and try again.</p><p><br /></p>";
	}
	
} // End of the main Submit conditional.
?>
<h2>Register</h2>
<form action="register.php" method="post">
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="15" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="30" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="40" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Password: <input type="password" name="password1" size="10" maxlength="20" /></p>
	<p>Confirm Password: <input type="password" name="password2" size="10" maxlength="20" /></p>
	<p><input type="submit" name="submit" value="Register" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
<?php
include ('./includes/footer.html');
?>
