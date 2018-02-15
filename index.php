
<?php
	// Error reporting if using a MAC
	// ini_set('display_errors', 1);
	// error_reporting(E_ALL);
	
	require_once('admin/phpscripts/config.php');
	if(isset($_GET['filter'])){
		$tbl = "tbl_movies";
		$col = "movies_id";
		$tblGenre = "tbl_genre";
		$tblMovGenre = "tbl_mov_genre";
		$genreId = "genre_id";
		$genreName = "genre_name";
		$filter = $_GET['filter'];
		// order must be the EXACT same as the filterType function!!!
		$getMovies = filterType($tbl, $tblGenre, $tblMovGenre, $col, $genreId, $genreName, $filter);
		$tblUser = "tbl_user";
	}else{
		$tbl = "tbl_movies";
		$getMovies = getAll($tbl);
	}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome to the Finest Selection of Blu-rays on the internets!</title>
</head>
<body>

	<?php
		include('includes/nav.html');

		// ! means if it is not a string
		if(!is_string($getMovies)) {
			while($row = mysqli_fetch_array($getMovies)){
				// \ is a cancelling character, it is needed for the strings 
				echo "<img src = \"images/{$row['movies_cover']}\" alt=\"{$row['movies_title']}\">
				<h2>{$row['movies_title']}</h2>
				<p>{$row['movies_year']}</p>
				<a href=\"details.php?id={$row['movies_id']}\"> More Details...</a>
				<br></br>
				";

			}
		}else{
			echo "<p class=\"error\">{$getMovies}</p>";
		}

		include('includes/footer.html');
	?>

</body>
</html>