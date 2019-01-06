<?php
	$columns=$_POST["nocol"];
	$name=$_POST["resourcename"];
	session_start();
	$_SESSION["name"]=$name;
	$_SESSION["columns"]=$columns;
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
	echo '<form action="addresourcetype2.php" method="post">';
	for ($i = 0; $i < $columns; $i++) {
		echo "Name of Column $i : ";
		echo " ";
        echo "<input type="."text"." name="."a".$i." >";
        echo " ";
        echo "Type of Column $i : ";
		echo '<select name='."b$i".'>
				<option value="INT">INT</option>
				<option value="VARCHAR(30)">VARCHAR</option>
				<option value="TEXT">TEXT</option>
				<option value="DATE">DATE</option>
			</select>';
        echo "<br>";
		echo "<br>";
	}
	echo '<input type="submit" value = "create table">';
	echo "</form>";
	echo "</html>";
	?>
