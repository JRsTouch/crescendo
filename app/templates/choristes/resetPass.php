<?php $this->layout('login', ['title' => 'Nouveau Password', 'layout' => $layout]); ?>

<?php $this->start('main_content');  ?>

 
	<form action="#" method="POST" accept-charset="utf-8">
		<label for="email">Vôtre Email? : <input type="text" name="email">
		<button type="submit" name="sent">Envoyer</button>
	</form>

	<a href="<?= $this->url('users_login') ?>">Retour à la page connexion</a>

<?php $this->stop('main_content'); ?>