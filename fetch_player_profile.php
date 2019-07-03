<?php
	$req = $_GET['q'];

	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	// connect to db
	$db = new DB_CONNECT();
	$conn = $db->connect();

	$sql_p = "SELECT Firstname, Lastname, Age, Position, PlayerID, Nationality, Birthdate FROM Player WHERE PlayerID=".$req;

	$result = $conn->query($sql_p);

	$arr = array();

	while ($row = mysqli_fetch_array($result) ) {
		$arr["Firstname"] = $row['Firstname'];
		$arr["Lastname"] = $row['Lastname'];
		$arr["Position"] = $row['Position'];
		$arr['PlayerID'] = $row['PlayerID'];

		$arr["Nationality"] = $row['Nationality'];
		$arr["Birthdate"] = $row["Birthdate"];
		$arr['Age'] = $row["Age"];
	}
	echo json_encode($arr)
			
?>