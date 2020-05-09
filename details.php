<?php 
	require 'config.php';

	if(!isset($_GET['pokemon']) || empty($_GET['pokemon'])){
		header('Location: index.php');
	}

	$data = queryPokeAPI('pokemon/'.$_GET['pokemon']);
	if(!$data){
		header('Location: index.php');
	}

	$data->sprite = reset($data->sprites);
	if(!reset($data->sprites)){
		// no image found on first index
		$data->sprite = 'unknown-pokemon.png';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View <?= ucfirst(join(' ', explode('-', $data->name))); ?> on Pokedex</title>
	 <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:wght@400;700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Pokedex</h1>

	<div class="container">  <!-- TODO: Change to Flex + Center vertically to the page -->
		<div class="titleBar">
			<label for="pokemon"><?= ucfirst(join(' ', explode('-', $data->name))); ?></label>
		</div>
		
		<div class="pokeOutput">
			<div>
				<div class="imageContainer">
					<div class="poke-name-num">
						<span class="name poke-info"></span>
						<span class="idNum poke-info"></span>
					</div>
				
					<div class="size">
						<span class="poke-info"><span class="weight"></span></span>
						<span class="poke-info"><span class="height"></span></span>
					</div>
				
					<img src="<?= $data->sprite ?>" alt="<?= ucfirst(join(' ', explode('-', $data->name))); ?> sprite" class="pokeImage">
					<div class="types"></div>
				</div>
			</div>
			
			<div class="bottom-container">
				<table>
					<tr>
						<th>Base</th>
						<th>Stats</th>
					</tr>
					<?php 
						foreach($data->stats as $stat){
							echo '<tr>';
								echo '<td>';
									echo strtoupper(join(' ', explode('-', $stat->stat->name)));
								echo '</td>';
								echo '<td>';
									echo $stat->base_stat;
								echo '</td>';
							echo '</tr>';
						} 
					?>
				</table>
			</div>
		</div>
	</div>
	
	<script src="scripts.js"></script>
</body>
</html>