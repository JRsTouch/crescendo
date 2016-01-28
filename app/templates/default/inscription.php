<?php $this->layout('login', ['title' => 'CrescendO : Connexion']); ?>

<?php $this->start('main_content');  ?>

	<main>
		<div id="register">
			<form action="#" method="post">
				<label for="fname">Prénom:</label>
				<input type="text" name="fname">

				<label for="lname">Nom:</label>
				<input type="text" name="lname">

				<label for="email">Email:</label>
				<input type="text" name="email">

				<label for="password">Mot de passe:</label>
				<input type="password" name="password">

				<label for="check">Teléphone ?</label>
				<input id="checkbox"type="checkbox" name="check">				

				<label class="tel" for="tel">Numéro de téléphone:</label>
				<input class="tel" type="text" name="tel">

				<label for="pupitre">Pupitre :</label>
				<select name="pupitre">
					<option value="basse">Basse</option>
					<option value="tenor">Tenor</option>
					<option value="alto">Alto</option>
					<option value="soprane1">Soprane 1</option>
					<option value="soprane1">Soprane 2</option>
				</select>
				
				<button type="submit" name="sent">Valider</button>
			</form>
			<a href="<?= $this->url('home') ?>">Retour à l'acceuil</a>
		</div>
	</main>

<?php $this->stop('main_content'); ?>