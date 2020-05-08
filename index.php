<?php 
	require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pokedex</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Pokedex</h1>

	<?php 
		$data = queryPokeAPI('pokemon?limit=-1')->results;
	?>
	<ul>
		<?php 
			foreach($data as $pokemon){
				echo '<li>';
					echo '<a href="details.php?pokemon='.$pokemon->name.'">';
						echo ucfirst(join(' ', explode('-', $pokemon->name)));
					echo '</a>';
				echo '</li>';
			}
		?>
	</ul>

	<script src="scripts.js"></script>
</body>
</html>