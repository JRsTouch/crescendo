<?php $this->layout('layout', ['title' => 'Accueil !']) ?>

<?php $this->start('main_content') ?>
	<header>
		<img src="<?php echo $data['header' => 'url_logo']?>" alt="logo"> <!-- Récupération de l'url dans le tableau data -->
		<div class="container">
		<h1><?php echo $data['header' => 'title']?> </h1> <!-- Récupération du titre dans le tableau data -->
		<nav>
		
		</nav>
		</div>
	</header><!-- /header -->

	<div id="presentation">
		<div class="container">
			

		</div>
	</div>
	
	<section id="actus">
		<div class="container">
			

		</div>
	</section>

	<div id="video">
		<div class="container">
			

		</div>
	</div>

	<div id="photo">
		<div class="container">
			

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
