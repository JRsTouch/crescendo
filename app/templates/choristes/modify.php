<?php $this->layout('choristes', ['title' => 'Modifications !', 'layout' => $layout ]); ?>


<?php $this->start('main_content');  ?>
		<h3>Modification du profil: <?= $layout['user']['username'] ?></h3>
		<form action="#" id="sentmail" method="post" accept-charset="utf-8">
			<fieldset>
				<legend>Modification de l'email</legend>
				<input type="text" name="email" value="<?= $layout['user']['email'] ?>">
				<button type="submit" name="sentmail" class="accmod">Valider</button>
			</fieldset>
		</form>

		<form action="#" id="senttel" method="post" accept-charset="utf-8">
			<fieldset>
				<legend>Modification du numéro de téléphone</legend>
				<input type="text" name="tel" value="<?php 
															if(isset($layout['user']['tel'])){
																echo $layout['user']['tel'] ;
															}?>">
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