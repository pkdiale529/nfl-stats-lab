<?php
	/*
	* Following code will create a new player row (or record)
	* All new player details will be read from HTTP POST Request
	*/

	$user = $_POST['user'];
	$newplayer = json_decode($user, true);

	// array for JSON response
	$response = array();
	
	$firstname = $newplayer['firstname'];
	$lastname = $newplayer['lastname'];
	$birthdate = $newplayer['birthdate'];
	$age = $newplayer['age'];
	$nationality = $newplayer['nationality'];
	$email = $newplayer['email'];
	$position = $newplayer['position'];

	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	// connect to db
	$db = new DB_CONNECT();
	$conn = $db->connect();

	// inserting a new row (or record)
	$result = $conn->query("INSERT INTO Player(Firstname, Lastname, Birthdate, Age, Nationality, Position, Email)
							VALUES('$firstname', '$lastname', '$birthdate', '$age', '$nationality', '$position', '$email')");

	if ($position == 'QB') {
		$sql = ("INSERT INTO Quarter_Back(PlayerID) 
						SELECT MAX(PlayerID)
						FROM Player
						WHERE Position='QB'");
	} else if ($position == 'TE') {
		$sql = ("INSERT INTO WR_TE(PlayerID, Position) 
						SELECT MAX(PlayerID), Position
						FROM Player
						WHERE Position='TE'");
	} else if ( $position == 'WR') {
		$sql = ("INSERT INTO WR_TE(PlayerID, Position) 
						SELECT MAX(PlayerID), Position
						FROM Player
						WHERE Position='WR'");
	} else if ($position == 'RB') {
		$sql = ("INSERT INTO Running_Back(PlayerID) 
						SELECT MAX(PlayerID)
						FROM Player");
	} else if ($position == 'LB') {
		$sql = ("INSERT INTO Defense(PlayerID, Position) 
						SELECT MAX(PlayerID), Position
						FROM Player
						WHERE Position='LB'");
	} else if ($position == 'S') {
		$sql = ("INSERT INTO Defense(PlayerID, Position) 
						SELECT MAX(PlayerID), Position
						FROM Player
						WHERE Position='S'");
	} else if ($position == 'CB') {
		$sql = ("INSERT INTO Defense(PlayerID, Position) 
						SELECT MAX(PlayerID), Position
						FROM Player
						WHERE Position='CB'");
	} else if ($position == 'K') {
		$sql = ("INSERT INTO Kicker(PlayerID) 
						SELECT MAX(PlayerID)
						FROM Player
						WHERE Position='K'");
	}

	$conn->query($sql);

	// check if row (or record) is inserted or not
	if ($result) {
		// successfully inserted into database
		$response['success'] = 1;
		$response['message'] = $firstname . " " . $lastname . " has been added to the team! With PlayerID";
		echo json_encode($response);
	} else {
		// unsuccessful insertion
		$response['success'] = 0;
		$response['message'] = "Oops! An error occurred.";
		echo json_encode($response);
	}
	
	$conn->close();
?>