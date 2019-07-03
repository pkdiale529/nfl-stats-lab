<?php
	$data = $_POST['arr'];

	$stats = json_decode($data, true);

	$response = array(); // record error messages and send to client
	$data = array(); // to store data from database

	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	// connect to db
	$db = new DB_CONNECT();
	$conn = $db->connect();

	$pid = $stats['playerID'];
	$tablename = $stats['role'];

	foreach ($stats as $key => $value) {
		# code...
		$colValue = $key;
		$sql = "SELECT $colValue FROM $tablename WHERE PlayerID='$pid' ";
		$result = $conn->query($sql);
		if ($result) {
			while ($row = mysqli_fetch_array($result)) {
				foreach ($row as $rkey => $rvalue) {
					# code...
					$data[$value] = $rvalue;
				}
			}
		}
	}

	echo json_encode($data);

	$conn->close();
	/*if ($result) {
		while ($row = mysqli_fetch_array($result)) {
			$data['tdp'] = $row['Touchdown_Passes'];
			$data['ry'] = $row['Rushing_Yards'];
		}
		echo json_encode($data);
	} else {
		$response['msg'] = "Failed to fetch Player's Stats";
		echo json_encode($response);
	}*/
?>