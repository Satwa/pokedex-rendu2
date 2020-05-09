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

	<div class="container <?= $data->types[0]->type->name ?>">
		<div class="titleBar <?= $data->types[0]->type->name ?>">
			<label for="pokemon"><?= ucfirst(join(' ', explode('-', $data->name))); ?></label>
		</div>
		
		<div class="pokeOutput">
			<div>
				<div class="imageContainer">
					<div class="size">
						<span class="pokeInfo"><span class="weight"><?= $data->weight ?></span></span>
						<span class="pokeInfo"><span class="height"><?= $data->height ?></span></span>
					</div>
				
					<img src="<?= $data->sprite ?>" alt="<?= ucfirst(join(' ', explode('-', $data->name))); ?> sprite" class="pokeImage">
				</div>
			</div>
			
			<div class="bottomContainer">
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