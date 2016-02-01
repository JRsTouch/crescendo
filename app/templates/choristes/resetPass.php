<?php $this->layout('login', ['title' => 'CrescendO : Nouveau Password', 'layout' => $layout]); ?>

<?php $this->start('main_content');  ?>

 	<main>
		<form action="#" method="POST" accept-charset="utf-8" id="reset">
			<label for="email">Votre Email? : <input type="text" name="email">
			<button type="submit" name="sent">Envoyer</button>
		</form>

		<a href="<?= $this->url('users_login') ?>">Retour à la page de connexion</a>
	</main>

<?php $this->stop('main_content'); ?>