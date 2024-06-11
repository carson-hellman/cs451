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
	Paying fine
	</h3>

	<hr>

	<?php

	$ID = $_POST['customerID'];
	$ID = mysqli_real_escape_string($conn, $ID);

	$query = "UPDATE fine\n
		  SET isPaid=1\n
		  WHERE customer_custID='$ID'";

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
		echo "Fines successfully paid <hr><hr>";
	}
	else
	{
		echo "ERROR: Unable to pay fines <hr><hr>";
	}
	
	mysqli_close($conn);

	?>

<a href="home.html">Return to the home page</a>

<hr>
<a href="source/paid_fines.txt" >Contents</a> of the PHP program that created this page.

</body>
</html>
