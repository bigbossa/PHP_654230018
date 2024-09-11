<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'DB_654230018';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();

include 'Navlogin.php';
?>

<html>

<head>
	<meta charset="utf-8">
	<title>Profile Page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	<!-- Bootstrap JS (for dropdown functionality) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="loggedin">
	<section class="m-3">
		<div class="container" style="background-color: aliceblue;"
			<h2 class="m-3">Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?= htmlspecialchars($_SESSION['name'], ENT_QUOTES) ?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?= htmlspecialchars($password, ENT_QUOTES) ?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?= htmlspecialchars($email, ENT_QUOTES) ?></td>
					</tr>
				</table>
			</div>
			<a href="homeadmin.php" class="btn btn-info m-3">Go back</a>
		</div>
	</section>
	
</body>

</html>