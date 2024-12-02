<?php require_once 'main/handleForms.php'; ?>
<?php require_once 'main/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit</title>
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
	<h1>Edit</h1>
	<form action="main/handleForms.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="POST">
		<p>
			<label for="first_name">First Name</label>
			<input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($getUserByID['first_name']); ?>" required>
		</p>
		<p>
			<label for="last_name">Last Name</label>
			<input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($getUserByID['last_name']); ?>" required>
		</p>
		<p>
			<label for="email">Email</label>
			<input type="email" id="email" name="email" value="<?php echo htmlspecialchars($getUserByID['email']); ?>" required>
		</p>
		<p>
			<label for="gender">Gender</label>
			<select id="gender" name="gender" required>
				<option value="male" <?php if ($getUserByID['gender'] === 'male') echo 'selected'; ?>>Male</option>
				<option value="female" <?php if ($getUserByID['gender'] === 'female') echo 'selected'; ?>>Female</option>
				<option value="other" <?php if ($getUserByID['gender'] === 'other') echo 'selected'; ?>>Other</option>
			</select>
		</p>
		<p>
			<label for="job_position">Job Position</label>
			<input type="text" id="job_position" name="job_position" value="<?php echo htmlspecialchars($getUserByID['job_position']); ?>" required>
		</p>
		<p>
			<label for="contact_no">Contact No.</label>
			<input type="text" id="contact_no" name="contact_no" value="<?php echo htmlspecialchars($getUserByID['contact_no']); ?>" required>
		</p>
		<p>
			<input type="submit" value="Save Changes" name="editApplicantBtn">
		</p>
	</form>
</body>
</html>
