<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<link rel="shortcut icon" href="<?= $this->assetUrl('img/favicon.ico') ?>" />
	<script src="<?= $this->assetUrl('js/jquery-2.1.4.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/jquery-ui.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/calendar.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/footer.js') ?>" async defer></script>	
	<link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href="<?= $this->assetUrl('css/jquery-ui.css') ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/choristes_home.css') ?>">
	<?php 

		if (isset($layout['tags']['link'])){
			foreach ($layout['tags']['link'] as $link) {
				echo '<link rel="stylesheet" href="'.$this->assetUrl($link).'">';
			}
		}

		if (isset($layout['tags']['script'])){
			foreach ($layout['tags']['script'] as $script){
				echo '<script src="'.$this->assetUrl($script).'" type="text/javascript" charset="utf-8" async defer></script>';
			}
		}

		
	?>
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

				<li class="enable_hover"><a href="<?= $this->url('choristes_actus') ?>">Actus</a></li>
				
				
				<li <?php if (isset($layout['chansons'])) { echo "class=\"disable_hover\"" ;} else { echo "class=\"enable_hover\"" ;} ?>><a href="<?= $this->url('choristes_chansons') ?>">Chansons</a>
					<?php
						if (isset($layout['chansons'])) {
							echo'<ul id="liste_chansons">';
							foreach ($layout['chansons'] as $chanson) {
								?>
								<li class="enable_hover"><a href="<?= $this->url('choristes_chanson', [ 'id' => $chanson['id'] ])?>"><?= ucwords(preg_replace('/[_]/',' ',$chanson['titre']))?></a></li>
								<?php
								
							}
							echo"</ul>";
						}
					?>
				</li>
				<li class="enable_hover"><a href="<?= $this->url('choristes_membres') ?>">Membres</a></li>

				


				
				<!-- Partie accessible à partir du membre du CA  -->
				<?php if( $layout['user']['role'] == 'bureau' || $layout['user']['role'] == 'gestion' || $layout['user']['role'] == 'chef' || $layout['user']['role'] == 'admin'): ?>
					<li class="enable_hover"><a href="<?= $this->url('choristes_documents_officiels') ?>">Documents Bureau</a></li>				
					<li class="enable_hover"><a href="https://ssl0.ovh.net/roundcube/?_user=chorale@crescendo.site" target="_blank">Accès messagerie</a></li>
				<?php endif ?>
				
				<!-- Partie reservée aux chefs de choeur -->
				<?php if($layout['user']['role'] == 'chef' || $layout['user']['role'] == 'admin'): ?>
					<li <?php if (isset($layout['update_chansons'])) { echo "class=\"disable_hover\"" ;} else { echo "class=\"enable_hover\"" ;} ?>><a href="<?= $this->url('choristes_chansons_ajout',[ 'update' => false ]) ?>">Gestion Chanson</a>
						<?php 
							if ( isset($layout['update_chansons']) ) {
								echo'<ul id="liste_chansons">';
								foreach ($layout['update_chansons'] as $chanson) {
									?>
										<li><a href="<?= $this->url('choristes_chansons_update', [ 'id' => $chanson['id'], 'update' => true ])?>"><?= ucwords(preg_replace('/[_]/',' ',$chanson['titre']))?></a></li>
									<?php
								}
								echo '</ul>';
							}
						 ?>
					</li>


					<li class="enable_hover"><a href="<?= $this->url('choristes_repetitions') ?>">Gestion Répetition</a></li>
				<?php endif ?>
				
				<!-- Partie reservée au gestionnaire de contenu -->
				<?php if($layout['user']['role'] == 'gestion' ||$layout['user']['role'] == 'bureau' || $layout['user']['role'] == 'chef' || $layout['user']['role'] == 'admin'): ?>
					<li class="enable_hover"><a href="<?= $this->url('choristes_ajout_contenu') ?>">Gestion Contenu</a></li>
				<?php endif ?>

				<!-- Partie reservée à L'administrateur -->
				<?php if($layout['user']['role'] == 'admin'): ?>
					<li class="enable_hover"><a href="<?= $this->url('choristes_management') ?>">Gestion Profils</a></li>
				<?php endif ?>
					<li class="enable_hover"><a href="<?php echo $this->url('home');?>">Retour à l'Accueil</a></li>
			</ul>
		</nav>

	</div>
	
	<?= $this->section('main_content') ?>

		<footer>
			<div id="credits">©2016 - CrescendO Joeuf® . Credits : <?php
															echo "<ul>";
															foreach ( $layout['options'] as $value) {
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
														?>

			</div>
			
			<div class="hover panel">
  				<div class="front">
        			<div class="pad">
        				<a href="https://www.facebook.com/groups/140046179408954/" target="_blank">
            				<img src="<?= $this->assetUrl('img/facebook_off.png') ?>" alt="logo facebook front" width="64" height="64"/>
            			</a>
       				</div>
    			</div>

    			<div class="back">
        			<div class="pad">
        				<a href="https://www.facebook.com/groups/140046179408954/" target="_blank">
            				<img src="<?= $this->assetUrl('img/facebook_on.png') ?>" alt="logo facebook front" width="64" height="64"/>
            			</a>
        			</div>
    			</div>
			</div>

		</footer>	

</body>
</html>