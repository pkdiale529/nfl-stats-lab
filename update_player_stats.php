<?php

	$data = $_POST['data'];

	$stats = json_decode($data, true);

	//global variables - stats that apply to most players
	$position = $stats['position'];
	$pid = $stats['playerID'];

	if ($position == "QB") {
		$touchdown_passes = $stats['touchdown_passes'];
		$passing_yards = $stats['passing_yards'];
		$interceptions = $stats['interceptions'];
		$pass_completions = $stats['pass_completions'];
		$pass_attempts = $stats['pass_attempts'];
		$rushing_yards = $stats['rushing_yards'];

		$sql = "UPDATE Quarter_Back
				SET Touchdown_Passes='$touchdown_passes', Rushing_Yards='$rushing_yards', Passing_Yards='$passing_yards', Interceptions='$interceptions', Pass_Completions='$pass_completions', Pass_Attempts='$pass_attempts'
				WHERE PlayerID = '$pid' ";

	} else if ($position == 'RB') {
		$rushing_touchdowns = $stats['rushing_touchdowns'];
		$carries = $stats['carries'];
		$rushing_yards = $stats['rushing_yards'];
		$receptions = $stats['receptions'];
		$receiving_touchdowns = $stats['receiving_touchdowns'];
		$receiving_yards = $stats['receiving_yards'];

		$sql = "UPDATE Running_Back
				SET Rushing_Yards='$rushing_yards', Rushing_Touchdowns='$rushing_touchdowns', Carries='$carries', Receptions='$receptions', Receiving_Touchdowns='$receiving_touchdowns', Receiving_Yards='$receiving_yards' 
				WHERE PlayerID = '$pid' ";
	} else if ($position == "WR" || $position == "TE") {
		$receiving_touchdowns = $stats['receiving_touchdowns'];
		$receptions = $stats['receptions'];
		$rushing_yards = $stats['rushing_yards'];
		$receiving_yards = $stats['receiving_yards'];
		$sql = "UPDATE WR_TE
				SET Receiving_Touchdowns='$receiving_touchdowns', Rushing_Yards='$rushing_yards', Receiving_Yards='$receiving_yards', Receptions='$receptions'
				WHERE PlayerID='$pid' ";
	} else if ($position == "K") {
		$field_goals_made = $stats['field_goals_made'];
		$field_goal_attempts = $stats['field_goal_attempts'];
		$sql = "UPDATE Kicker
				SET Field_Goals_Made='$field_goals_made', Field_Goal_Attempts='$field_goal_attempts'
				WHERE PlayerID='$pid' ";
	} else if ($position == "S" || $position == "CB" || $position == "LB") {
		$ff = $stats['fumbles_forced'];
		$interceptions = $stats['interceptions'];
		$tackles = $stats['tackles'];
		$sacks = $stats['sacks'];
		$sql = "UPDATE Defense
				SET Fumbles_Forced='$ff', Interceptions='$interceptions', Tackles='$tackles', Sacks='$sacks'
				WHERE PlayerID='$pid' ";
	}
	

	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	// connect to db
	$db = new DB_CONNECT();
	$conn = $db->connect();

	$result = $conn->query($sql);

	$response = array();

	if ($result) {
		$response['msg'] = "Records updated!";
	} else {
		$response['msg'] = "Something went wrong!";
	}

	echo json_encode($response)
			
?>