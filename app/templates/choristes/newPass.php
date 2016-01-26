<?php $this->layout('login', ['title' => 'Nouveau Password', 'layout' => $layout]); ?>

<?php $this->start('main_content');  ?>
 
	<form action="#" method="POST" accept-charset="utf-8">
		<label for="newpass">Nouveau Mot de passe :<input type="password" name="newpass">
		<label for="checkpass">Vérification Mot de passe :<input type="password" name="checkpass">
		<button type="submit" name="sent">Envoyer</button>
	</form>

<?php $this->stop('main_content'); ?>