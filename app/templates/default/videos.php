<?php $this->layout('videos', ['title' => 'Videos !']) ?>

<?php $this->start('main_content') ?>

	<div id="player">
		
	</div>
	<ul>
		<?php foreach($videos as $key => $value): ?>

			<li><a class="videos" href="<?= $value['url'] ?>" data-embed="<?= preg_replace('/watch\?v=/', 'v/',  $value['url']) ?>" data-description="<?= $value['description'] ?>"><?= $value['titre'] ?></a></li>

		<?php endforeach ?>
	</ul>

	<a href="<?= $this->url('home') ?>">Retour a l'accueil !</a>


<?php $this->stop('main_content') ?>
