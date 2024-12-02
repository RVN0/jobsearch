<?php require_once 'main/models.php'; ?>
<?php require_once 'main/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete</title>
	<link rel="stylesheet" href="styles/style1.css">
</head>
<body>
	<?php 
	if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
		echo '<p>Invalid user ID.</p>';
		exit;
	}
	$getUserByID = getApplicantByID($pdo, $_GET['id']); 
	if (!$getUserByID) {
		echo '<p>User not found.</p>';
		exit;
	}
	?>
	<h1>Are you sure you want to delete this user?</h1>
	<div class="container" style="border-style: solid; border-color: red; background-color: #ffcbd1; height: auto; padding: 20px;">
		<h2>First Name: <?php echo htmlspecialchars($getUserByID['first_name']); ?></h2>
		<h2>Last Name: <?php echo htmlspecialchars($getUserByID['last_name']); ?></h2>
		<h2>Email: <?php echo htmlspecialchars($getUserByID['email']); ?></h2>
		<h2>Gender: <?php echo htmlspecialchars($getUserByID['gender']); ?></h2>
		<h2>Job Position: <?php echo htmlspecialchars($getUserByID['job_position']); ?></h2>
		<h2>Contact No.: <?php echo htmlspecialchars($getUserByID['contact_no']); ?></h2>

		<div class="deleteBtn" style="margin-top: 20px;">
			<form action="main/handleForms.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="POST">
				<input type="submit" name="deleteApplicantBtn" value="Delete" style="background-color: #f69697; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer;">
			</form>			
		</div>
	</div>
</body>
</html>
