<?php $this->layout('choristes', ['title' => 'Modifications !', 'layout_data' => $data['options'][0]['copyrights'], 'layout' => $layout, 'user' => $data['user'] ]); ?>


<?php $this->start('main_content');  ?>
		<h3>Modification du profil: <?= $data['user']['username'] ?></h3>
		<form action="#" id="sentmail" method="post" accept-charset="utf-8">
			<fieldset>
				<legend>Modification de l'email</legend>
				<input type="text" name="email" value="<?= $_SESSION['user']['email'] ?>">
				<button type="submit" name="sentmail" class="accmod">Valider</button>
			</fieldset>
		</form>

		<form action="#" id="senttel" method="post" accept-charset="utf-8">
			<fieldset>
				<legend>Modification du numéro de téléphone</legend>
				<input type="text" name="email" value="<?= $_SESSION['user']['tel'] ?>">
				<button type="submit" name="senttel" class="accmod">Valider</button>
			</fieldset>
		</form>

		<form action="#" id="sentpass" method="post" accept-charset="utf-8">
			<fieldset>
				<legend>Modification du mot de passe</legend>
				<label>Mot de passe actuel :<input type="password" name="password"></label>
				<label>Nouveau mot de passe :<input type="password" name="newpass"></label>
				<label>Confirmer mot de passe :<input type="password" name="checkpass"></label>
				<button type="submit" name="sentpass" class="accmod">Valider</button>
			</fieldset>
		</form>



<?php $this->stop('main_content'); ?>