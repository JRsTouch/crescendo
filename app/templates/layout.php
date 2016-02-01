<!DOCTYPE html>
<html lang="fr" xmlns:og="http://ogp.me/ns#">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="L'actualité de la chorale pop-rock CrescendO de Joeuf, concerts, vidéos, photos: Cinquante choristes et sept musiciens sur scène revisitent les plus grand titres de la variété française et internationale" />
		<meta name="keywords" content="CrescendO, chorale, pop-rock, joeuf, chant, vertige de l'amour" />
		<meta name="author" content="Julien Raletz, David Lapoint, Mélanie Marcon">
		<meta name="robots" content="index, follow">
		<meta name="revisit-after" content="3 months">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= $this->e($title) ?></title>
		<link rel="shortcut icon" href="<?= $this->assetUrl('img/favicon.ico') ?>" />
		<script src="<?= $this->assetUrl('js/jquery-2.1.4.min.js') ?>"></script>
		<script src="<?= $this->assetUrl('js/facebook.js') ?>"></script>
		<script src="<?= $this->assetUrl('js/footer.js') ?>" async defer></script>
		<script src="<?= $this->assetUrl('js/analytics.js') ?>"></script>



		<?php 

			if (isset($layout_display['tags']['link'])){
				foreach ($layout_display['tags']['link'] as $link) {
					echo '<link rel="stylesheet" href="'.$this->assetUrl($link).'">';
				}
			}

			if (isset($layout_display['tags']['script'])){
				foreach ($layout_display['tags']['script'] as $script){
					echo '<script src="'.$this->assetUrl($script).'"></script>';
				}
			}


			foreach ($layout_display['opengraph'] as $property	=>	$content) {
				echo '<meta property="og:'.$property.'" content="'.$content.'" />';
			}
		?>
		<link rel="stylesheet" href="<?= $this->assetUrl('css/responsive_short_screen.css') ?>">
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
							<li><a href="<?= $this->url('users_login') ?>" rel="nofollow">Coin des Choristes</a></li> <!-- No follow de Googlebot et autres sur la partie privée -->
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
							<label for="name">Votre Nom :<input type="text" name="name" placeholder="..."></label>
							<label for="email">Votre Email :<input type="email" name="email" placeholder="exemple@crescendo.site"></label>
							<label for="message">Votre Message :<textarea name="message" placeholder="Bonjour.."></textarea></label>
							<button type="submit" name="sent">Envoyer</button>
						</form>

					</div>
			</div>

			<?php
		} 		
			?>

		<footer>
				<div id="credits">©2016 - CrescendO Joeuf® . Credits : <?php
															echo "<ul>";
															foreach ( $layout_data[0]['copyrights'] as $value) {
																if ( $value == 'Lapointe David') {
																	echo "<li class=\"enable_hover\"><a href=\"http://gameparadise.fr\" target=\"_blank\">".$value."</a></li>";
																}
																if ( $value == 'Marcon Mélanie') {
																	echo "<li class=\"enable_hover\"><a href=\"https://fr.linkedin.com/in/mélanie-marcon-07268210b\" target=\"_blank\">".$value."</a></li>";
																}
																if ( $value == 'Raletz Julien') {
																	echo "<li class=\"enable_hover\"><a href=\"https://fr.linkedin.com/in/julien-raletz-74a5a7109\" target=\"_blank\">".$value."</a></li>";
																}
															}
															
															echo "</ul>";

														?> </div>

				<?php if ($layout_display['name'] == 'home'): ?>					
    				<a href="#" id="goup">Retour en haut</a>		
				<?php endif ?>

			
				<div class="hover panel">
	  				<div class="front">
	        			<div class="pad">
	        				<a href="https://www.facebook.com/CrescendOJoeuf/" target="_blank">
	            				<img src="<?= $this->assetUrl('img/facebook_off.png') ?>" alt="logo facebook front" width="64" height="64"/>
	            			</a>
	       				</div>
	    			</div>

	    			<div class="back">
	        			<div class="pad">
	        				<a href="https://www.facebook.com/CrescendOJoeuf/" target="_blank">
	            				<img src="<?= $this->assetUrl('img/facebook_on.png') ?>" alt="logo facebook front" width="64" height="64"/>
	            			</a>
	        			</div>
	    			</div>
				</div>
		</footer>

</body>
</html>