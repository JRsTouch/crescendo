<?php $this->layout('choristes', ['title' => 'Ajout de News', 'layout_data' => $data['options'][0]['copyrights'], 'layout' => $layout, 'user' => $data['user'] ]); ?>

<?php $this->start('main_content');  ?>
 	
 	<form action="#" method="POST" accept-charset="utf-8">
 		<label for="date">Date: <input type="date" name="date"></label>
 		<label for="heure">heure: <input type="time" name="heure"></label>
 		<label for="description">Description: <input type="text" name="description"></label>
 		<button type="submit" name="sent">Valider</button>
 	</form>

<?php $this->stop('main_content'); ?>