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
	Returning a rental
	</h3>

	<hr>

	<?php
	$rentalID = $_POST['rentalID'];

	$status = $_POST['Status'];

	$query = "UPDATE rental\n
		  SET isReturned=1\n
		  WHERE rentalID='$rentalID'";

	$query_array = (explode("\n", $query));
	foreach ($query_array as $i)
	{
		#echo "$i <br>";
	}
	?>

	<hr>

	<?php
	$result = mysqli_query($conn, $query)
	or die(mysqli_error($conn));

	if($result==TRUE)
	{
		echo "Rental table has been updated with return <hr><hr>";
	}
	else
	{
		echo "ERROR: unsuccessfull return <hr><hr>";
	}
	
	$query = "SELECT customer_custID, movie_movieID, book_bookID\n
		  FROM rental\n
		  WHERE rentalID='$rentalID'";
	
	$query_array = (explode("\n", $query));
	foreach ($query_array as $i)
	{
		#echo "$i <br>";
	}
	
	$result = mysqli_query($conn, $query)
	or die(mysqli_error($conn));
	
	if($result==TRUE)
	{
		echo "Retrieved customerID <hr><hr>";
	}
	else
	{
		echo "ERROR: Unable to retrieve customerID <hr><hr>";
	}

	$row = mysqli_fetch_array($result, MYSQLI_BOTH);
	$custID = $row[0];

	
	# make movie or book available again
	$query = "UPDATE movie\n
		  SET isAvailable=1\n
		  WHERE movieID=$row[1]";

	if ($row[1] === NULL) #movie is NULL therefore rented book
	{
		$query = "UPDATE book\n
			  SET isAvailable=1\n
			  WHERE bookID=$row[2]";
	}

	$query_array = (explode("\n", $query));
	foreach ($query_array as $i)
	{
		#echo "$i <br>";
	}

	$result = mysqli_query($conn, $query)
	or die(mysqli_error($conn));
	
	if($result==TRUE)
	{
		echo "Rental item(movie/book) has been made available again <hr><hr>";
	}
	else
	{
		echo "ERROR: Rental item was NOT made available again <hr><hr>";
	}


	# deal with late fee (add $5 fine)
	if($status==0)
	{
		$query = "INSERT INTO fine (fineID, amount, isPaid, customer_custID, location_locationID, rental_rentalID)\n
			  SELECT count(*), 5, 0, '$custID', 1, '$rentalID'\n
			  FROM fine";

		$query_array = (explode("\n", $query));
		foreach ($query_array as $i)
		{
			#echo "$i <br>";
		}

		$result = mysqli_query($conn, $query)
		or die(mysqli_error($conn));

		if($result==1)
		{
			echo "Customer recieved late fee <hr><hr>";
		}
		else
		{
			echo "ERROR: Failed to assign late fee to customer <hr><hr>";
		}
	}

	mysqli_close($conn);

	?>

<a href="home.html">Return to the home page</a>

<hr>
<a href="source/rental_return.txt" >Contents</a> of the PHP program that created this page.

</body>
</html>
