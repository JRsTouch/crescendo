<!DOCTYPE html>

<html lang="fr" xmlns:og="http://ogp.me/ns#">
	<head>
		<meta charset="UTF-8">
		<title><?= $this->e($title) ?></title>
		<script src="<?= $this->assetUrl('js/jquery-2.1.4.min.js') ?>"></script>
		<?php 
			foreach ($layout_display['tags']['link'] as $link) {
				echo '<link rel="stylesheet" href="'.$this->assetUrl($link).'">';
			}


			foreach ($layout_display['tags']['script'] as $script){
				echo '<script src="'.$this->assetUrl($script).'"></script>';
			}

			foreach ($layout_display['opengraph'] as $property	=>	$content) {
				echo '<meta property="og:'.$property.'" content="'.$content.'" />';
			}
		 ?>
		<link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

	</head>
<body>
	<?php 
		// Header de la page principale
		if ($layout_display['name'] == 'home') {
			?>
			<header>
				<img src="<?= $layout_data[0]['url_logo'] ?>" alt="logo"> <!-- Récupération de l'url dans le tableau data -->
				<div class="container">

					<h1><?php echo $layout_data[0]['titre']?></h1> <!--  </h1> Récupération du titre dans le tableau data --> 
					<nav id="posfixed">
						<ul>
							<li><a href="#presentation">Présentation</a></li>
							<li><a href="#actus">Actualités</a></li>
							<li><a href="#video">Vidéos</a></li>
							<li><a href="#photo">Photos</a></li>
							<li><a href="#contact">Contact</a></li>
							<li><a href="<?= $this->url('users_login') ?>">Coin des Choristes</a></li> 
						</ul>
						<div
						  class='fb-share-button'
						  data-href='http://crescendo.site'
						  data-type='button_count'>
						</div>
					</nav>

				</div>						
				
			</header>
			<?php
		// Header des autres pages
		} else {
			?>
				<header>

					<div class="container">

						<h1><?php echo $layout_data[0]['titre']?></h1> <!--  </h1> Récupération du titre dans le tableau data --> 
						<a href="<?php echo $this->url('home');?>">Retour à l'accueil</a>
					</div>
				</header>
			<?php

		}
	 ?>

	<?= $this->section('main_content') ?>


	<?php
		// Formulaire de contact sur : Page principale, Page présentation .
		if($layout_display['name'] == 'home' || $layout_display['name'] == 'presentation'){
			?>

			<div id="contact">
					<div class="container">
						<h2>Nous contacter</h2>
						<form action="<?= $this->url('contact') ?>" method="POST" accept-charset="utf-8">
							<label for="name">Votre Nom :<input type="text" name="name" placeholder=""></label>
							<label for="email">Votre Email :<input type="email" name="email" placeholder="example@crescendo.site"></label>
							<label for="message">Votre Message :<textarea name="message" placeholder="Bonjour.."></textarea></label>
							<button type="submit" name="sent">Envoyer</button>
						</form>

					</div>
			</div>

			<?php
		} 		
			?>

		<footer>
			<div class="container">
				<p>©2016 - CrescendO Joeuf® . Credits : <?php
															echo "<ul>";
																												
															foreach ($layout_data[0]['copyrights'] as $value) {
																echo "<li>".$value."</li>";
															}
															
															echo "</ul>";
														?> </p>
				

			</div>
		</footer>

</body>
</html>