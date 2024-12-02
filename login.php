<?php  
require_once 'main/models.php'; 
require_once 'main/handleForms.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="styles/loginstyle.css">
</head>
<body>
	<?php  
	if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
		$messageColor = ($_SESSION['status'] == "200") ? "green" : "red";
		echo "<h1 style='color: $messageColor;'>{$_SESSION['message']}</h1>";
	}
	unset($_SESSION['message']);
	unset($_SESSION['status']);
	?>
	
	<h1>Login Now!</h1>
	<form action="main/handleForms.php" method="POST" class="login-form">
		<p>
			<label for="username">Username</label>
			<input type="text" id="username" name="username" required>
		</p>
		<p>
			<label for="password">Password</label>
			<input type="password" id="password" name="password" required>
		</p>
		<p>
			<input type="submit" name="loginUserBtn" value="Login">
		</p>
	</form>
	<p>Register <a href="register.php">here</a></p>
</body>
</html>
