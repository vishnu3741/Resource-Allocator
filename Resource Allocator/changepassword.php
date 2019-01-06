<?php
	$user=$_POST["uname"];
	$opass=$_POST["opass"];
	$npass=$_POST["npass"];
	$rnpass=$_POST["rnpass"];
	$servername = "localhost";
	$usernameofserver = "root";
	$passwordofserver = "Teja!1995";
	$dbname="project";
	$mysqli = new mysqli($servername, $usernameofserver, $passwordofserver, $dbname);
	$connection = new mysqli($servername, $usernameofserver, $passwordofserver, $dbname);
	$sql = "SELECT * FROM login";
	$result = $mysqli->query($sql);
	if(!$result){
			echo 'Could not run query: ' . mysqli_error();
	}
	else{
		while($row = $result->fetch_assoc()){
			if($row["username"] == $user){
				$realpassword = $row["password"];
			}
		}
	}
	if($realpassword == $opass){
		if($npass == $rnpass){
			$sql = "UPDATE login SET password='$npass' WHERE username='$user'";
			if($connection->query($sql) === TRUE){
				echo "<script>
					alert('Your Password is Changed');
					window.location.href='adminoptions.html';
					</script>";
				}
			else{
				echo $connection->error;
			}
		}
		else{
			echo "<script>
				alert('Re-Entered Different Password');
				window.location.href='adminoptions.html';
				</script>";
		}
	}
	else{
		echo "<script>
		alert('Old Password is Wrong');
		window.location.href='adminoptions.html';
		</script>";
	}
?>
			
	
