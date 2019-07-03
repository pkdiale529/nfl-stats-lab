<?php
	$req = $_GET['q'];
	//echo $req;
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	// connect to db
	$db = new DB_CONNECT();
	$conn = $db->connect();

	if ($req == "D") {
		$sql = "SELECT * FROM Player P, Defense D WHERE P.PlayerID = D.PlayerID";
	} else {
		$sql = "SELECT * FROM Player WHERE Position= '".$req."'";
	}

    $result = $conn->query($sql);
    $arr = array();
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
    	$arr[$i]['Firstname'] = $row['Firstname'];
    	$arr[$i]['Lastname'] = $row['Lastname'];
    	$arr[$i]['PlayerID'] = $row['PlayerID'];
    	$i++;	
    }
    $json = json_encode($arr);
    echo $json;
?>