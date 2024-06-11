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
	Attempt to add new movie
	</h3>

	<hr>

	<?php

	$title = $_POST['title'];
	$title = mysqli_real_escape_string($conn, $title);

	$director = $_POST['director'];
	$director = mysqli_real_escape_string($conn, $director);

	$genre = $_POST['genre'];
	$genre = mysqli_real_escape_string($conn, $genre);
	
	$released = $_POST['released'];
	$released = mysqli_real_escape_string($conn, $released);
	$released = date($released);

	$availability = $_POST['availability'];
	$availability = mysqli_real_escape_string($conn, $availability);

	$query = "INSERT INTO movie\n
		  SELECT count(*), '$title', '$director', '$genre', '$released', '$availability', 1\n
		  FROM movie"

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

	if ($result == 1)
	{
		print("Successfully added $title");
	}
	else
	{
		print("Query was unsuccessful");
	}
	
	mysqli_close($conn);

	?>

<hr>
<a href="home.html">Return to the home page</a>

<hr>
<a href="source/new_movie.txt" >Contents</a> of the PHP program that created this page.

</body>
</html>
