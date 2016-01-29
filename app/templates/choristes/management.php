<?php $this->layout('choristes', ['title' => 'CrescendO : Gestion des membres !', 'layout' => $layout ]); ?>

<?php $this->start('main_content');  ?>

<main>

	<p>Nouveau membres</p>

	<ul>
		
	<?php foreach($data['membres'] as $key => $value): ?>
		
		<?php if($value['role'] == NULL): ?>	
			<li><a class="membermanage"href="#" data-role="<?= $value['role'] ?>"data-tel="<?= $value['tel'] ?>" data-tel="<?= $value['tel'] ?>" data-id="<?= $value['id'] ?>" data-email="<?= $value['email'] ?>"><?= $value['username'] ?></a> <em><?= $value['pupitre'] ?></em></li>
		<?php endif ?>

	<?php endforeach ?>

	</ul>

	<p>Membres existant</p>

	<ul>
		
	<?php foreach($data['membres'] as $key => $value): ?>
		
		<?php if($value['role'] != NULL): ?>
			<li><a class="membermanage"href="#" data-role="<?= $value['role'] ?>"data-tel="<?= $value['tel'] ?>" data-tel="<?= $value['tel'] ?>" data-id="<?= $value['id'] ?>" data-email="<?= $value['email'] ?>"><?= $value['username'] ?></a> <em><?= $value['pupitre'] ?></em></li>
		<?php endif ?>

	<?php endforeach ?>

	</ul>
	
	<div id="manageform">
		
		<h3></h3>
		<div id="form">
			<form action="#" method="post" accept-charset="utf-8">
				<input type="hidden" name="id" value="">
				<label>Email :</label>
				<input type="text" name="email">
				<label>Telephone :</label>
				<input type="text" name="tel">
				<label>Rang :</label>
				<select name="role">
					<option value="choriste">choriste</option>
					<option value="bureau">bureau</option>
					<option value="gestion">gestion</option>
					<option value="chef">chef</option>
					<option value="admin">admin</option>
				</select>
				<button type="submit" name="sent">Valider les modification</button>	
			</form>	
			<a href="#">Annuler</a>
		</div>			
	</div>		

</main>

<?php $this->stop('main_content'); ?>