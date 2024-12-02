<?php  

require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertApplicantBtn'])) {
	$insertUser = insertNewApplicant($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['gender'], $_POST['job_position'], $_POST['contact_no']);

	if ($insertUser) {
        logActivity(
            $pdo,
            $_SESSION['username'],
            'Insert',
            "Inserted applicant: {$_POST['first_name']} {$_POST['last_name']}"
        );
        $_SESSION['message'] = "Successfully inserted!";
        header("Location: ../index.php");
    }
}


if (isset($_POST['editApplicantBtn'])) {
	$editUser = editApplicant($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['gender'], $_POST['job_position'], $_POST['contact_no'], $_GET['id']);

	if ($editUser) {
        logActivity(
            $pdo,
            $_SESSION['username'],
            'Edit',
            "Edited applicant ID: {$_GET['id']}, Name: {$_POST['first_name']} {$_POST['last_name']}"
        );
		$_SESSION['message'] = "Successfully edited!";
		header("Location: ../index.php");
	}
}

if (isset($_POST['deleteApplicantBtn'])) {
	$deleteUser = deleteApplicant($pdo,$_GET['id']);

	if ($deleteUser) {
        logActivity(
            $pdo,
            $_SESSION['username'],
            'Delete',
            "Deleted applicant ID: {$_GET['id']}"
        );
		$_SESSION['message'] = "Successfully deleted!";
		header("Location: ../index.php");
	}
}

if (isset($_GET['searchBtn'])) {
	$searchForAUser = searchForApplicant($pdo, $_GET['searchInput']);

    logActivity(
        $pdo,
        $_SESSION['username'],
        'Search',
        "Searched for: {$_GET['searchInput']}"
    );

	foreach ($searchForAUser as $row) {
		echo "<tr> 
				<td>{$row['id']}</td>
				<td>{$row['first_name']}</td>
				<td>{$row['last_name']}</td>
				<td>{$row['email']}</td>
				<td>{$row['gender']}</td>
				<td>{$row['job_position']}</td>
				<td>{$row['contact_no']}</td>
			  </tr>";
	}
}

if (isset($_POST['insertNewUserBtn'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Insert new user into the database
        $insertQuery = insertNewUser(
            $pdo,
            $username,
            password_hash($password, PASSWORD_DEFAULT)
        );

        if ($insertQuery['status'] == '200') {
            $_SESSION['message'] = $insertQuery['message'];
            $_SESSION['status'] = $insertQuery['status'];
            header("Location: ../login.php");
            exit;
        } else {
            $_SESSION['message'] = $insertQuery['message'];
            $_SESSION['status'] = $insertQuery['status'];
            header("Location: ../register.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "Please make sure there are no empty input fields.";
        $_SESSION['status'] = "400";
        header("Location: ../register.php");
        exit;
    }
}

if (isset($_POST['loginUserBtn'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $loginQuery = checkIfUserExists($pdo, $username);

        if ($loginQuery['status'] == '200') {
            $usernameFromDB = $loginQuery['userInfoArray']['username'];
            $passwordFromDB = $loginQuery['userInfoArray']['password'];

            if (password_verify($password, $passwordFromDB)) {
                $_SESSION['username'] = $usernameFromDB;
                header("Location: ../index.php");
                exit;
            } else {
                $_SESSION['message'] = "Invalid password.";
                $_SESSION['status'] = "400";
                header("Location: ../login.php");
                exit;
            }
        } else {
            $_SESSION['message'] = $loginQuery['message'];
            $_SESSION['status'] = $loginQuery['status'];
            header("Location: ../login.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "Please make sure no input fields are empty.";
        $_SESSION['status'] = "400";
        header("Location: ../login.php");
        exit;
    }
}

if (isset($_GET['logoutUserBtn'])) {
    unset($_SESSION['username']);
    header("Location: ../login.php");
    exit;
}


?>