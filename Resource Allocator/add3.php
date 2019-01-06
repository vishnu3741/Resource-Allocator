<?php
	$servername="localhost";
	$username="root";
	$password="Teja!1995";
	$dbname="project";
	$connection = new mysqli($servername, $username, $password, $dbname);
	if ($connection->connect_error) {
		die("Connection failed: ".$connection->connect_error);
	}
	session_start();
	$table=$_SESSION["table"];
	$sql=$_SESSION["sql"];
	$num=$_SESSION["num"];
	$sql=$sql." (";
	for ($i = 0; $i <$num; $i++) {
		if($i !== $num-1){
			$sql=$sql."'".$_POST["a$i"]."'".", ";
		}
		else{
			$sql=$sql."'".$_POST["a$i"]."'"." )";
		}
	}
	if($connection->query($sql) === TRUE){
		echo "<script>
		alert('The Resource is added to succesfully.');
		window.location.href='add2.html';
		</script>";
	}
	else{
		echo "<script>
		alert('Some Error Occured.');
		window.location.href='add2.html';
		</script>";
	}
?>
