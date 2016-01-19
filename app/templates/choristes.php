<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<script src="<?= $this->assetUrl('js/jquery-2.1.4.min.js') ?>"></script>
	<link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/choristes_home.css') ?>">
</head>

<body>
	<div id="container">
		
		<div id="user">
			
		</div>

		<nav>
			<ul>
				<li><a href="<?= $this->url('choristes_ajout_news') ?>">Actus</a></li>
				<li><a href="<?= $this->url('choristes_chansons') ?>">Chansons</a></li>
				<li><a href="">Membres</a></li>
				<li><a href="">Documents Bureau</a></li>
				<li><a href="">Messagerie du site ()</a></li>
				<li><a href="<?= $this->url('choristes_chansons_ajout') ?>">Gestion Chanson</a></li>
				<li><a href="">Gestion Répetition</a></li>
				<li><a href="">Gestion Contenu</a></li>
				<li><a href="">Gestion Profils</a></li>
			</ul>
		</nav>

	</div>
	
	<?= $this->section('main_content') ?>

		<footer>
			<p>©2016 - CrescendO Joeuf® . Credits : <?php
															echo "<ul>";
																												
															foreach ($layout_data as $value) {
																echo "<li>".$value."</li>";
															}
															
															echo "</ul>";
														?> </p>
				
		</footer>

</body>
</html>