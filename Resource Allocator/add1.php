<?php
	$servername = "localhost";
	$username = "root";
	$password = "Teja!1995";
	$dbname = "project";
	session_start();
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$table=$_POST['resourcetype'];
	$id = $_POST['id'];
	$num=$_POST['number_of_resources'];
	$sql = "UPDATE $table SET available=available+$num WHERE id=$id";
	if (mysqli_query($conn, $sql)) {
		echo "<script>
		alert('Record Updated Sucessfully');
		window.location.href='add1.html';
		</script>";
	} 
	else {
    echo "Error updating record: " . mysqli_error($conn);
	}
	mysqli_close($conn);
?> 
