<?php $this->layout('login', ['title' => 'Connexion']); ?>

<?php $this->start('main_content');  ?>

	<main>
		<p>Vôtre inscription a bien été prise en compte, un administrateur la validera dans les plus brefs délais.</p>		
		<a href="<?= $this->url('home') ?>">Retour à l'acceuil</a>
	</main>

<?php $this->stop('main_content'); ?>