<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<script src="<?= $this->assetUrl('js/jquery-2.1.4.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/facebook.js') ?>"></script>
	<link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<?php
		// Page d'accueil
		if ($layout_display['ismain'] && $layout_display['form']) {
			?>
			<script src="<?= $this->assetUrl('js/jquery.flexslider.js') ?>"></script>
			<link rel="stylesheet" href="<?= $this->assetUrl('css/flexslider.css') ?>">
			<link rel="stylesheet" href="<?= $this->assetUrl('css/home.css') ?>">
			<script src="<?= $this->assetUrl('js/javascript.js') ?>"></script>
			<?php
		// Page présentation
		} else if (!$layout_display['ismain'] && $layout_display['form']) {
			?>
			<link rel="stylesheet" href="<?= $this->assetUrl('css/presentation.css') ?>">
			<?php
		// Pages Presse, Images, Videos
		} else if (!$layout_display['ismain'] && !$layout_display['form']) {
			?>
			<script src="<?= $this->assetUrl('js/ajax.js') ?>"></script>
			<link rel="stylesheet" href="<?= $this->assetUrl('css/medias.css') ?>">
			<?php
		}
	 ?>


</head>
<body>
	<?php 
		// Header de la page principale
		if ($layout_display['ismain']) {
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
		} else if (!$layout_display['ismain']){
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
		if($layout_display['form']){
			?>

			<div id="contact">
					<div class="container">
						<h2>Nous contacter</h2>
						<form action="<?= $this->url('contact') ?>" method="POST" accept-charset="utf-8">
							<label for="name">Votre Nom :<input type="text" name="name" placeholder="Doe John"></label>
							<label for="email">Votre Email :<input type="email" name="email" placeholder="Doe.john@crescendo.fr"></label>
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