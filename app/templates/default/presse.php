<?php $this->layout('medias', ['title' => 'Articles de presse']); //permet d'afficher le layout.php ?> 

<?php $this->start('main_content');//Il faut placer entre start et stop le main content ?>

	<div id="presse" class="view">
		
	</div>
	
	<main>

		<div class="container">

			<ul>

			<?php foreach ($articles as $article): ?>
				
				<li><a class="article" href="<?= $article['titre'] ?>" data-description="<?= $article['description'] ?>"><?= $article['titre'] ?></a></li>
				
			<?php endforeach ?>	

			</ul>

		</div>

	</main>

<?php $this->stop('main_content'); ?>



