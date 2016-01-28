<?php $this->layout('login', ['title' => 'CrescendO : Connexion']); ?>

<?php $this->start('main_content');  ?>

	<main>
		<div id="form">
			<form action="#" method="post">
				<label for="login">Email:</label>
				<input type="text" name="login" placeholder="exemple@crescendo.site">	
				<label for="password">Mot de passe:</label>
				<input type="password" name="password" placeholder="*****">
				<button type="sbumit" name="sent">Connexion</button>
			</form>			
			<a href="<?= $this->url('users_inscription') ?>">Inscription</a>
			<a href="<?= $this->url('users_reset') ?>">Mot de passe oublié?</a>
		</div>
	</main>

<?php $this->stop('main_content'); ?>