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
	Available books for rent
	</h3>

	<hr>

	<?php
	$query = "SELECT *\n
		  FROM book\n
		  WHERE isAvailable=1"
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
	Books:
	<br>
	<br>

	<?php
	$result = mysqli_query($conn, $query)
	or die(mysqli_error($conn));
	

	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		printf("%s, %s, %s, %s, %s<br>", $row[0], $row[1], $row[2], $row[3], $row[4]);
	}
	
	mysqli_close($conn);

	?>

<hr>
<a href="home.html">Return to the home page</a>

<hr>
<a href="source/book_availability.txt" >Contents</a> of the PHP program that created this page.

</body>
</html>
