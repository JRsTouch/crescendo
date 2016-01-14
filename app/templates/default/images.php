<?php $this->layout('images', ['title' => 'Images !']) ?>

<?php $this->start('main_content') ?>

	<div id="slider">
		<a id="previous" href="" data-description="" data-alt="" data-index="">previous</a>
		<a id="next" href="" data-description="" data-alt="" data-index="">next</a>
	</div>
	<ul>
		<?php foreach($images as $key => $value): ?>

			<li><a class="images" href="<?= $value['url'] ?>" data-description="<?= $value['description'] ?>" data-alt="<?= $value['description'] ?>" data-index="<?= $key ?>"><?= $value['alt'] ?></a></li>
			
		<?php endforeach ?>
	</ul>

	<a href="<?= $this->url('home') ?>">Retour a l'accueil !</a>


<?php $this->stop('main_content') ?>
