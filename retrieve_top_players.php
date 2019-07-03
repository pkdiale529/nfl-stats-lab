<?php
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	// connect to db
	$db = new DB_CONNECT();
	$conn = $db->connect();

	$thebest = array();
	$i = 0;

	//best QB request
	$sql = "SELECT Firstname, Lastname, Age, MAX(Touchdown_Passes) AS Touchdown_Passes FROM Quarter_Back Q, Player P WHERE Q.PlayerID = P.PlayerID GROUP BY Touchdown_Passes";
	$result = $conn->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$thebest[$i]['Fname'] = $row['Firstname'];
		$thebest[$i]['Lname'] = $row['Lastname'];
		$thebest[$i]['Age'] = $row['Age'];
		$thebest[$i]['Touchdown_Passes'] = $row['Touchdown_Passes'];
	}
	$i++;
	//best Kicker request
	$sql = "SELECT Firstname, Lastname, Age, MAX(Field_Goals_Made) AS Field_Goals_Made FROM Kicker K, Player P WHERE K.PlayerID = P.PlayerID GROUP BY Field_Goals_Made";
	$result = $conn->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$thebest[$i]['Fname'] = $row['Firstname'];
		$thebest[$i]['Lname'] = $row['Lastname'];
		$thebest[$i]['Age'] = $row['Age'];
		$thebest[$i]['Field_Goals_Made'] = $row['Field_Goals_Made'];
	}
	$i++;
	//best RB request
	$sql = "SELECT Firstname, Lastname, Age, MAX(Rushing_Touchdowns) AS Rushing_Touchdowns FROM Running_Back R, Player P WHERE R.PlayerID = P.PlayerID GROUP BY Rushing_Touchdowns";
	$result = $conn->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$thebest[$i]['Fname'] = $row['Firstname'];
		$thebest[$i]['Lname'] = $row['Lastname'];
		$thebest[$i]['Age'] = $row['Age'];
		$thebest[$i]['Rushing_Touchdowns'] = $row['Rushing_Touchdowns'];
	}
	$i++;
	//best WR request
	$sql = "SELECT Firstname, Lastname, Age, MAX(Sacks) AS Sacks FROM Defense D, Player WHERE D.PlayerID = P.PlayerID GROUP BY Sacks";
	$result = $conn->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$thebest[$i]['Fname'] = $row['Firstname'];
		$thebest[$i]['Lname'] = $row['Lastname'];
		$thebest[$i]['Age'] = $row['Age'];
		$thebest[$i]['Sacks'] = $row['Sacks'];
	}
	$i++;
	//best Fullback request
	$sql = "SELECT Firstname, Lastname, Age, MAX(Receiving_Touchdowns) AS Receiving_Touchdowns FROM WR_TE W, Player P WHERE W.PlayerID = P.PlayerID GROUP BY Receiving_Touchdowns";
	$result = $conn->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$thebest[$i]['Fname'] = $row['Firstname'];
		$thebest[$i]['Lname'] = $row['Lastname'];
		$thebest[$i]['Age'] = $row['Age'];
		$thebest[$i]['Receiving_Touchdowns'] = $row['Receiving_Touchdowns'];
	}
	echo json_encode($thebest);
?>