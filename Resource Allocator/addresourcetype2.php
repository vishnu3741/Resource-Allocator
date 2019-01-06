<?php
	$servername="localhost";
	$username="root";
	$password="Teja!1995";
	$dbname="project";
	$connection = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: ".$connection->connect_error);
	}
	session_start();
	$name=$_SESSION["name"];
	$num=$_SESSION["columns"];
	$sql="CREATE TABLE ".$name." (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
	available INT(5) ";
	for ($i = 0; $i <$num; $i++) {
		$sql=$sql.",".$_POST["a$i"]." ".$_POST["b$i"]." ";
	}
	$sql=$sql." )";
	if ($connection->query($sql) === TRUE) {
		echo "<script>
		alert('Table Created Sucessfully');
		window.location.href='addresourcetype.html';
		</script>";
	} 
	else {
		echo "<script>
		alert('Error Creating Table');
		window.location.href='addresourcetype.html';
		</script>";
	}
?>
