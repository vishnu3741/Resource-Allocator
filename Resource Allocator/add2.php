<?php
	$servername = "localhost";
	$username = "root";
	$password = "Teja!1995";
	$dbname = "project";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$table=$_POST['resourcetype'];
	$sql="SELECT * FROM ".$table;
	$result=mysqli_query($conn,$sql);  
	$num=mysqli_num_fields($result);
	$array = array_fill ( 0,  $num , "hi" ); 
	$sql1 = "SHOW COLUMNS FROM $table";
	$query=mysqli_query($conn,$sql1);
	$i=0;
	while($row = mysqli_fetch_array($query)){
		$array[$i]=$row['Field'] ;
		$i=$i+1;
	}
	$sql="INSERT INTO ".$table." ( ";
	for($i=0;$i<$num;$i++){
		if($i !== $num-1){
			$sql=$sql.$array[$i].", ";
		}
		else{
			$sql=$sql.$array[$i]." )"." VALUES ";
		}
	}
	session_start();
	$_SESSION["table"]=$table;
	$_SESSION["sql"]=$sql;
	$_SESSION["num"]=$num;
	echo "<br>";
	echo "<html>";
	echo "<style>
input[type=text], select {
    width: 30%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=Password], select {
    width: 30%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=Number], select {
    width: 30%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 10%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}
div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 200px;
}
</style>";
	echo "<h1> Input The Values </h1>";
	echo '<form action="add3.php" method="post">';
	echo "<br>";
	for($i=0;$i<$num;$i++){
		$qwe = $array[$i]." : ";
		echo "<input type="."text"." name="."a".$i." placeholder=".$qwe." >";
		echo "<br>";
	}
	echo '<input type="submit" value = "add">';
	echo "</form>"; 
	mysqli_close($conn);
	echo "</html>";
?> 
