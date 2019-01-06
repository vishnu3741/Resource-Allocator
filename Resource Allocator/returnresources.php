<?php
	$servername = "localhost";
	$usernameofserver = "root";
	$passwordofserver = "Teja!1995";
	$name=$_POST["studentname"];
	$roll=$_POST["rollnumber"];
	$dbname="project";
	$type=$_POST["nameofresource"];
	$resourceid=$_POST["idresource"];
	$returnid=$_POST["id"];
	$number=$_POST["num"];
	$connection = new mysqli($servername, $usernameofserver, $passwordofserver, $dbname);
	$index=0;
	$claim=0;
	if($connection->connect_error){
		die("Connection Failed: " . $connection->connect_error);
	}
	echo "Name of the student = ".$name;
	echo "<br>";
	echo "Roll Number of student = ".$roll;
	echo "<br>";
	echo "Name of Resource = ".$type;
	echo "<br>";
	echo "ID of Resource = ".$resourceid;
	echo "<br>";
	echo "Number of Resources = ".$number;
	echo "<br>";
	echo "Response:";
	echo "<br>";
	if($_POST["return"]){
		$sql1 = "DELETE FROM claimers WHERE id=".$returnid;
		$sql2 = "UPDATE ".$type." SET available=available+".$number." WHERE id=".$resourceid;
		$sql3="SELECT name FROM claimers WHERE id =".$returnid;
		$mysqli = new mysqli($servername, $usernameofserver, $passwordofserver, $dbname);
		$sql7="SELECT * FROM claimers";
		$result1 = $mysqli->query($sql7);
		$result = $connection->query($sql3);
		if (!$result1) {
			echo 'Could not run query: ' . mysqli_error();
		}
		while($row = $result1->fetch_assoc()) {
			if ($row["rollnumber"] == $roll) {
				$claim = $row["numberofresourcesclaimed"];
				break;
			}
		}
		if($result->num_rows === 0) {
			echo "Return ID is Wrong.";
		}
		else if($claim > $number){
			$still=$claim-$number;
			$sql8="UPDATE claimers SET numberofresourcesclaimed=numberofresourcesclaimed-".$number." WHERE rollnumber=".$roll;
			$sql9="UPDATE ".$type." SET available=available+".$number." WHERE id=".$resourceid;
			if($connection->query($sql8) === TRUE){
				if($connection->query($sql9)===TRUE){
					echo "Returned Sucessfully";
					echo "<br>";
					echo "You still have to return ".$still." resources of this type";
				}
				else{
					echo "Resource Returned But Not updated in ".$type." list.";
				}
			}
			else{
				echo "Some Error Occured While Returning.
					  Try Checking Your Resource Type and ID." . $connection->error;
				  }
		}
		else if($claim == $number){
			if ($connection->query($sql1) === TRUE) {
				if($connection->query($sql2) === TRUE) {
					echo "Returned Successfully";
				}
				else{
					echo "Resource Returned But Not updated in ".$type." list.";
				}
			}
			else{
				echo "Some Error Occured While Returning.
					  Try Checking Your Resource Type and Id." . $connection->error;
			}
		}
		else{
			echo "you are returning more than you claimed.";
		}
	}
	else if($_POST["claim"]){
		$sql4 = "INSERT INTO claimers (name, resourcetypeclaimed, numberofresourcesclaimed,idofresourceclaimed, rollnumber)VALUES ('$name', '$type', '$number', '$resourceid', '$roll')";
		$sql5 = "UPDATE ".$type." SET available=available-".$number." WHERE id=".$resourceid;
		$sql6 = "SELECT * FROM ".$type;
		$sql10 = "SELECT * FROM claimers";
		$mysqli = new mysqli($servername, $usernameofserver, $passwordofserver, $dbname);
		$result = $mysqli->query($sql6);
		$result1 = $mysqli->query($sql10);
		if (!$result) {
			echo 'Could not run query: ' . mysqli_error();
		}
		while($row = $result->fetch_assoc()) {
			if ($row["id"] == $resourceid) {
				$ava = $row["available"];
			}
		}
		if($ava >= $number){
			if(!$result1) {
				echo 'Could not run query: '.mysqli_error();
			}
			while($row = $result1->fetch_assoc()) {
				if($row["rollnumber"] == $roll && $row["idofresourceclaimed"] == $resourceid){
					$index = $row["id"];
					break;
				}
			}
			if($index !== 0){
				$sql11="UPDATE claimers SET numberofresourcesclaimed=numberofresourcesclaimed+".$number." WHERE id=".$index;
				if($connection->query($sql11) === TRUE){
					if($connection->query($sql5) === TRUE){
						echo "Your Claim is Recorded";
						echo "<br>";
						echo "Your return ID is ".$index;
					}
					else{
						echo "Your Claim is Recorded but not updated in the resource list";
					}
				}
				else{
					"Some error has occured resources cannot be claimed at the moment";
				}
			}
			else{
				if ($connection->query($sql4) === TRUE) {
					$last_id = $connection->insert_id;
					if($connection->query($sql5) ===TRUE) {
						echo "Your Claim is Recorded";
						echo "<br>";
						echo "Your return ID is ". $last_id;
					}
					else{
						echo "Your Claim is Recorded but not updated in the resource list";
					}
				}
				else {
					echo "Some error has occured resources cannot be claimed at the moment2";
				}
			}
		}
		else{
		echo "Required number of resources not available";
			}
	}
	$connection->close();
?>
