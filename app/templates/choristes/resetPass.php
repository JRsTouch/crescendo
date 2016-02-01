<?php $this->layout('login', ['title' => 'CrescendO : Nouveau Password', 'layout' => $layout]); ?>

<?php $this->start('main_content');  ?>

<main>
 	<div id="resetpass">
		<form action="#" method="POST" accept-charset="utf-8">
			<label for="email">Votre Email? : <input type="text" name="email"></label>
			<button type="submit" name="sent">Envoyer</button>
		</form>

		<a href="<?= $this->url('users_login') ?>">Retour à la page connexion</a>
	</div>
</main>

<?php $this->stop('main_content'); ?>