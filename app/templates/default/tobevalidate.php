<?php $this->layout('login', ['title' => 'CrescendO : Connexion']); ?>

<?php $this->start('main_content');  ?>

	<main>
		<div id="validation">
			<p>Votre inscription a bien été prise en compte, un administrateur la validera dans les plus brefs délais.</p>
			<a href="<?= $this->url('home') ?>">Retour à l'acceuil</a>
		</div>
	</main>

<?php $this->stop('main_content'); ?>