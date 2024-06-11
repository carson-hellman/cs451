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

	<hr>

	<?php

	$manufacturer = $_POST['manufacturer'];

	$manufacturer = mysqli_real_escape_string($conn, $manufacturer);
	
	$query = "SELECT c.fname, c.lname, s.description\n
		  FROM customer c\n
		  JOIN orders o ON(c.customer_num=o.customer_num)\n
		  JOIN items i ON(o.order_num=i.order_num)\n
		  JOIN stock s ON(i.stock_num=s.stock_num AND i.manu_code=s.manu_code)\n
		  JOIN manufact m ON(s.manu_code=m.manu_code)\n
		  WHERE m.manu_name = '$manufacturer'\n
		  ORDER BY c.lname, c.fname, s.description";

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
	<p>
	Result of query:
	<p>

	<?php
	$result = mysqli_query($conn, $query)
	or die(mysqli_error($conn));

	print "<pre>";
	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		print "\n";
		printf ("%-10s %-10s %5s", $row[0],$row[1],$row[2]);
	}


	mysqli_free_result($result);

	mysqli_close($conn);

	?>

<hr>
<a href="customer_orders_by_manufacturer_php.txt" >Contents</a> of the PHP program that created this page.

</body>
</html>
