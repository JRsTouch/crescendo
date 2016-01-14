<?php $this->layout('presentation', ['title' => 'Accueil !']) ?>

<?php $this->start('main_content') ?>
	<header>
		<div class="container">
		<img src="<?= $data['options'][0]['url_logo'] ?>" alt="logo"> <!-- Récupération de l'url dans le tableau data -->

		<h1><?php echo $data['options'][0]['titre']?></h1> <!--  </h1> Récupération du titre dans le tableau data --> 
		<a href="<?= $this->url('home') ?>">Retour à l'accueil</a>

		</div>
	</header><!-- /header -->

	<div id="presentation">
		<div class="container">
		<?= $data['options'][0]['description'] ?>
		<?= $data['options'][0]['description2'] ?>
		<?= $data['options'][0]['description3'] ?>
		<?= $data['options'][0]['description4'] ?>
	

		</div>
	</div>
	
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

	<footer>
		<div class="container">
			<p>©2016 - CrescendO Joeuf® . Credits : <?php
														echo "<ul>";
																											
														foreach ($data['options'][0]['copyrights'] as $value) {
															echo "<li>".$value."</li>";
														}
														
														echo "</ul>";
													?> </p>
			

		</div>
	</footer>




<?php $this->stop('main_content') ?>
