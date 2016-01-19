<?php $this->layout('login', ['title' => 'Connexion']); ?>

<?php $this->start('main_content');  ?>

	<main>
		<div id="register">
			<form action="#" method="post">
				<label for="fname">Prénom: <input type="text" name="fname"></label>	
				<label for="lname">Nom: <input type="text" name="lname"></label>	
				<label for="email">Email: <input type="text" name="email"></label>	
				<label for="password">Mot de passe: <input type="password" name="password"></label>
				<label for="pupitre">Pupitre :
					<select name="pupitre">
						<option value="basse">Basse</option>
						<option value="tenor">Tenor</option>
						<option value="alto">Alto</option>
						<option value="soprane1">Soprane 1</option>
						<option value="soprane1">Soprane 2</option>
					</select>
				</label>
				<button type="submit" name="sent">Valider</button>
			</form>
			<a href="<?= $this->url('home') ?>">Retour à l'acceuil</a>
		</div>
	</main>

<?php $this->stop('main_content'); ?>