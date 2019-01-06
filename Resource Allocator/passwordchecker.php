<?php
	$servername = "localhost";
	$usernameofserver = "root";
	$passwordofserver = "Teja!1995";
	$dbname="project";
	$user=$_POST["username"];
	$pass=$_POST["password"];
	session_start();
	$mysqli = new mysqli($servername, $usernameofserver, $passwordofserver, $dbname);
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
		if($realpassword == $pass && $pass !== ""){
			echo file_get_contents("adminoptions.html");
		}
		else{
			echo "<script>
			alert('Wrong Password or Username');
			window.location.href='admin.html';
			</script>";
		}
	} 
?>
	
