<?php require_once 'main/handleForms.php'; ?>
<?php require_once 'main/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Insert</title>
	<link rel="stylesheet" href="styles/style1.css">
</head>
<body>
	<h1>Insert</h1>
	<form action="main/handleForms.php" method="POST">
		<p>
			<label for="first_name">First Name</label>
			<input type="text" id="first_name" name="first_name" placeholder="Enter first name" required>
		</p>
		<p>
			<label for="last_name">Last Name</label>
			<input type="text" id="last_name" name="last_name" placeholder="Enter last name" required>
		</p>
		<p>
			<label for="email">Email</label>
			<input type="email" id="email" name="email" placeholder="Enter email" required>
		</p>
		<p>
			<label for="gender">Gender</label>
			<select id="gender" name="gender" required>
				<option value="" disabled selected>Select gender</option>
				<option value="male">Male</option>
				<option value="female">Female</option>
				<option value="other">Other</option>
			</select>
		</p>
		<p>
			<label for="job_position">Job Position</label>
			<input type="text" id="job_position" name="job_position" placeholder="Enter job position" required>
		</p>
		<p>
			<label for="contact_no">Contact No.</label>
			<input type="tel" id="contact_no" name="contact_no" placeholder="Enter contact number" required>
		</p>
		<p>
			<input type="submit" name="insertApplicantBtn" value="Insert User">
		</p>
	</form>
</body>
</html>
