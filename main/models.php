<?php  

require_once 'dbConfig.php';

function getAllApplicants($pdo) {
	$sql = "SELECT * FROM applicants
			ORDER BY first_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getApplicantByID($pdo, $id) {
	$sql = "SELECT * from applicants WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function searchForApplicant($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM applicants WHERE 
			CONCAT(first_name,last_name,email,gender,
				job_position,contact_no,date_added) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}



function insertNewApplicant($pdo, $first_name, $last_name, $email, 
	$gender, $job_position, $contact_no) {

	$sql = "INSERT INTO applicants 
			(
				first_name,
				last_name,
				email,
				gender,
				job_position,
                contact_no
			)
			VALUES (?,?,?,?,?,?)
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([
		$first_name, $last_name, $email, 
		$gender, $job_position, $contact_no
	]);

	if ($executeQuery) {
		return true;
	}

}

function editApplicant($pdo, $first_name, $last_name, $email, $gender, 
     $job_position, $contact_no, $id) {

	$sql = "UPDATE applicants
				SET first_name = ?,
					last_name = ?,
					email = ?,
					gender = ?,
					job_position = ?,
                    contact_no = ?
				WHERE id = ? 
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $email, $gender, 
		     $job_position, $contact_no, $id]);

	if ($executeQuery) {
		return true;
	}

}


function deleteApplicant($pdo, $id) {
	$sql = "DELETE FROM applicants
			WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return true;
	}
}

function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM users WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"result"=> false,
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertNewUser($pdo, $username, $password) {
	$response = array();
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	if (!$checkIfUserExists['result']) {

		$sql = "INSERT INTO users (username, password) 
		VALUES (?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $password])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}

function logActivity($pdo, $username, $action, $details) {
    $stmt = $pdo->prepare("INSERT INTO activity_log (username, action, details) VALUES (:username, :action, :details)");
    $stmt->execute([
        ':username' => $username,
        ':action' => $action,
        ':details' => $details
    ]);
}



?>