<?php

include('connection_data.txt');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect($server, $user, $password, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
	<head>
		<title>Simple PHP-MySQL Program</title>
	</head>

	<body bgcolor="white">
	
	<h3>
	Successfully added new employee
	</h3>

	<hr>

	<?php

	$fname = $_POST['fname'];
	$fname = mysqli_real_escape_string($conn, $fname);

	$lname = $_POST['lname'];
	$lname = mysqli_real_escape_string($conn, $lname);

	$position = $_POST['position'];
	$position = mysqli_real_escape_string($conn, $position);
	
	$phone = $_POST['phone'];
	$phone = mysqli_real_escape_string($conn, $phone);

	$wage = $_POST['wage'];
	$wage = mysqli_real_escape_string($conn, $wage);

	$query = "INSERT INTO worker\n
		  SELECT count(*), '$fname', '$lname', '$position', '$phone', '$wage'\n
		  FROM worker"

	?>

	<p>
	The query:
	<p>

	<?php
	$query_array = (explode("\n", $query));
	foreach ($query_array as $i)
	{
		echo "$i <br>";
	}
	?>

	<hr>

	<?php
	$result = mysqli_query($conn, $query)
	or die(mysqli_error($conn));
	
	mysqli_close($conn);

	?>

<a href="home.html">Return to the home page</a>

<hr>
<a href="source/new_hire_php.txt" >Contents</a> of the PHP program that created this page.

</body>
</html>
