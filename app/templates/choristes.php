<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<script src="<?= $this->assetUrl('js/jquery-2.1.4.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/jquery-ui.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/calendar.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/contenu.js') ?>" type="text/javascript" charset="utf-8" async defer></script>
	<script src="<?= $this->assetUrl('js/membres.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/management.js') ?>"></script>
	
	<script src="<?= $this->assetUrl('js/song.js') ?>"></script>
	
	<link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href="<?= $this->assetUrl('css/jquery-ui.css') ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/choristes_home.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/membres.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/management.css') ?>">
</head>

<body>
	
	<div id="container">
		
		<div id="user">

			<img src="<?= $this->assetUrl($layout['user']['avatar']) ?>" alt="avatar" width="100" height="100">
			<p><?= $layout['user']['username'] ?></p>
			<a href="<?= $this->url('users_modify') ?>">Modifier le profil</a>
			<a href="<?= $this->url('users_logout') ?>">Deconnexion</a>
			<div id="datepicker"></div>
		</div>

		<nav>
			<ul>
				<!-- Certaines Partie du menu sont visibles par défaut, d'autres réservées à certains rangs -->

				<li><a href="<?= $this->url('choristes_actus') ?>">Actus</a></li>
				
				<li><a href="<?= $this->url('choristes_chansons') ?>">Chansons</a>
					<?php
						if (isset($layout['chansons'])) {
							echo'<ul id="liste_chansons">';
							foreach ($layout['chansons'] as $chanson) {
								?>
								<li><a href="<?= $this->url('choristes_chanson', [ 'id' => $chanson['id'] ])?>"><?= ucwords(preg_replace('/[_]/',' ',$chanson['titre']))?></a></li>
								<?php
								
							}
							echo"</ul>";
						}
					?>
				</li>
				<li><a href="<?= $this->url('choristes_membres') ?>">Membres</a></li>

				


				
				<!-- Partie accessible à partir du membre du CA  -->
				<?php if( $layout['user']['role'] == 'bureau' || $layout['user']['role'] == 'gestion' || $layout['user']['role'] == 'chef' || $layout['user']['role'] == 'admin'): ?>
					<li><a href="">Documents Bureau</a></li>				
					<li><a href="">Messagerie du site ()</a></li>
				<?php endif ?>
				
				<!-- Partie reservée aux chefs de choeur -->
				<?php if($layout['user']['role'] == 'chef' || $layout['user']['role'] == 'admin'): ?>
					<li><a href="<?= $this->url('choristes_chansons_ajout',[ 'update' => false ]) ?>">Gestion Chanson</a>
						<?php 
							if ( isset($layout['update_chansons']) ) {
								echo'<ul id="liste_chansons">';
								foreach ($layout['update_chansons'] as $chanson) {
									?>
										<li><a href="<?= $this->url('choristes_chansons_update', [ 'id' => $chanson['id'], 'update' => true ])?>"><?= $chanson['titre']?></a></li>
									<?php
								}
								echo '</ul>';
							}
						 ?>
					</li>


					<li><a href="<?= $this->url('choristes_repetitions') ?>">Gestion Répetition</a></li>
				<?php endif ?>
				
				<!-- Partie reservée au gestionnaire de contenu -->
				<?php if($layout['user']['role'] == 'gestion' ||$layout['user']['role'] == 'bureau' || $layout['user']['role'] == 'chef' || $layout['user']['role'] == 'admin'): ?>
					<li><a href="<?= $this->url('choristes_ajout_contenu') ?>">Gestion Contenu</a></li>
				<?php endif ?>

				<!-- Partie reservée à L'administrateur -->
				<?php if($layout['user']['role'] == 'admin'): ?>
					<li><a href="<?= $this->url('choristes_management') ?>">Gestion Profils</a></li>
				<?php endif ?>
			</ul>
		</nav>

	</div>
	
	<?= $this->section('main_content') ?>

		<footer>
			<p>©2016 - CrescendO Joeuf® . Credits : <?php
															echo "<ul>";
															foreach ( $layout['options'][0]['copyrights'] as $value) {
																echo "<li>".$value."</li>";

															}
															
															echo "</ul>";
														?> </p>
				
		</footer>

</body>
</html>