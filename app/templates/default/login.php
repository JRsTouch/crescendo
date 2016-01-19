<?php $this->layout('login', ['title' => 'Connexion']); ?>

<?php $this->start('main_content');  ?>

	<main>
		<div id="form">
			<form action="#" method="post">
				<label for="login">Email: <input type="text" name="login"></label>	
				<label for="password">Mot de passe: <input type="password" name="password"></label>
				<button type="sbumit" name="sent">Valider</button>
			</form>			
			<a href="<?= $this->url('users_inscription') ?>">Inscription</a>
			<a href="<?= $this->url('users_reset') ?>">Mot de passe oublié</a>
		</div>
	</main>

<?php $this->stop('main_content'); ?>