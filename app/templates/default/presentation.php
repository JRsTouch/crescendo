<?php $this->layout('layout', ['title' => 'Accueil !']) ?>

<?php $this->start('main_content') ?>
	<header>
		<div class="container">
		<img src="<?= $data['options'][0]['url_logo'] ?>" alt="logo"> <!-- Récupération de l'url dans le tableau data -->

		<h1><?php echo $data['options'][0]['titre']?> <!--  </h1> Récupération du titre dans le tableau data --> 
		<nav>
		
		</nav>

		</div>
	</header><!-- /header -->

	<div id="presentation">
		<div class="container">
		<p><?= $data['options'][0]['description'] ?></p>
	

		</div>
	</div>
	
	<div id="contact">
		<div class="container">
			

		</div>
	</div>

	<footer>
		<div class="container">
			

		</div>
	</footer>




<?php $this->stop('main_content') ?>
