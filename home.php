<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost:3308';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
<style>
input[type=submit]{
	background-color: #4CAF50;
	border: none;
	color: white;
	padding: 16px 32px;
	text-decoration: none;
	margin: 4px 2px;
	cursor: pointer;
	}
form{ 
	text-align:center;
margin: 40px 630px;
}
</style>
		<meta charset="utf-8">
		
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Real Time Parking System</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				
			</div>
		</nav>
		<div class="content">
			
			<p>Welcome MH08Ak2686!</p>
		</div>
<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td>MH08AK2686</td>
					</tr>
					<tr>
						<td>Total time consumed:</td>
						<td>1-Hr 20-Min</td>
					</tr>
					<tr>
						<td>Amount to pay:</td>
						<td>Rs.50</td>
					</tr>
				</table>
			</div>
		</div>
<form action="last.php">
<input type="submit" name="pay" id="pay" value="Pay">
</form>
	</body>
</html>
