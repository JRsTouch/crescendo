<?php $this->layout('choristes', ['title' => 'CrescendO : Répétition', 'layout' => $layout]); ?>

<?php $this->start('main_content');  ?>

	<main>
		<p>Gestion des répétitions</p>
		<div id="form">
		 	<form action="#" method="POST" accept-charset="utf-8">
		 		<label for="date">Date: <input type="date" name="date"></label>
		 		<label for="heure">heure: <input type="time" name="heure"></label>
		 		<label for="description">Description: <input type="text" name="description"></label>
		 		<button type="submit" name="sent">Valider</button>
		 	</form>
		</div>
	</main>

<?php $this->stop('main_content'); ?>