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
	Book rental
	</h3>

	<hr>

	<?php

	$bookID = $_POST['bookID'];
	$bookID = mysqli_real_escape_string($conn, $bookID);

	$title = $_POST['title'];
	$title = mysqli_real_escape_string($conn, $title);

	$currentDate = $_POST['currentDate'];
	$currentDate = date($currentDate);
	
	$dueDate = $_POST['dueDate'];
	$dueDate = date($dueDate);
	
	$customerID = $_POST['customerID'];
	$customerID = mysqli_real_escape_string($conn, $customerID);

	$cost = $_POST['cost'];
	$cost = mysqli_real_escape_string($conn, $cost);
	
	$query = "INSERT INTO rental (rentalID, rentalDate, dueDate, cost, isReturned, location_locationID, customer_custID, book_bookID)\n
		  SELECT count(*), '$currentDate', '$dueDate', '$cost', 0, 1, '$customerID', '$bookID'\n
		  FROM rental";

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

	if ($result==True)
	{
		echo "Rental successful <hr><hr>";
	}
	else
	{
		echo "ERROR: Unable to complete rental <hr><hr>";
	}
	

	$query = "UPDATE book\n
		  SET isAvailable=0\n
		  WHERE bookID=$bookID";	
	
	$result = mysqli_query($conn, $query)
	or die(mysqli_error($conn));

	if ($result==True)
	{
		echo "Book successfully made unavailable <hr><hr>";
	}
	else
	{
		echo "ERROR: Unable to update book availability <hr><hr>";
	}

	mysqli_close($conn);

	?>

<a href="home.html">Return to the home page</a>

<hr>
<a href="source/book_rented.txt" >Contents</a> of the PHP program that created this page.

</body>
</html>
