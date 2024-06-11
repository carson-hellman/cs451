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
	Adding new customer
	</h3>

	<hr>

	<?php

	$fname = $_POST['fname'];
	$fname = mysqli_real_escape_string($conn, $fname);

	$lname = $_POST['lname'];
	$lname = mysqli_real_escape_string($conn, $lname);

	$address = $_POST['address'];
	$address = mysqli_real_escape_string($conn, $address);
	
	$phone = $_POST['phone#'];
	$phone = mysqli_real_escape_string($conn, $phone);

	$query = "INSERT INTO customer\n
		  SELECT count(*), '$fname', '$lname', '$address', '$phone'\n
		  FROM customer";

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
		echo "Customer successfully added <hr><hr>";
	}
	else
	{
		echo "ERROR: Unable to add customer <hr><hr>";
	}
	
	mysqli_close($conn);

	?>

<a href="home.html">Return to the home page</a>

<hr>
<a href="source/new_customer.txt" >Contents</a> of the PHP program that created this page.

</body>
</html>
