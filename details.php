<?php 
	require 'config.php';

	if(!isset($_GET['pokemon']) || empty($_GET['pokemon'])){
		header('Location: index.php');
	}

	$data = queryPokeAPI('pokemon/'.$_GET['pokemon']);
	if(!$data){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View <?= ucfirst(join(' ', explode('-', $data->name))); ?> on Pokedex</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Pokedex</h1>

	<?php 
		foreach($data->sprites as $sprite){
			echo '<img src="' . $sprite . '" alt="'. ucfirst(join(' ', explode('-', $data->name))) .'pokemon">';
		} 
	?>
	
	<h2>Stats</h2>
	<ul>
		<?php 
			foreach($data->stats as $stat){
				echo '<li>';
					echo $stat->base_stat . ' ' . strtoupper(join(' ', explode('-', $stat->stat->name)));
				echo '</li>';
			} 
		?>
	</ul>

	<h2>Abilities</h2>
	<ul>
		<?php 
			foreach($data->abilities as $ability){
				echo '<li>';
					echo ucfirst(join(' ', explode('-', $ability->ability->name)));
				echo '</li>';	
			}
		?>
	</ul>

	<script src="scripts.js"></script>
</body>
</html>