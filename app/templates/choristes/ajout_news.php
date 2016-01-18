<?php $this->layout('choristes', ['title' => 'Ajout de News']); ?>

<?php $this->start('main_content');  ?>
 	
 	<form enctype="multipart/form-data" action="#" method="post">
 		<input type="radio" name="article" value="article"> Article <br>
		<input type="radio" name="news" value="news" checked> News<br>
 		<label> Titre <input type="text" name="titre" value="" placeholder="Titre de l'article" required></label><br>
 		<label> Description </label><br>
 		<textarea name="description" required></textarea><br>
		Sélectionner le fichier : <input name="my-file" type="file" /><br>
		<input type="text" name="alt" value="" placeholder="description succinte de l'image"><br>
		<input type="text" name="desc_img" value="" placeholder="description complète de l'image"><br>
		<input type="submit" value="Envoyer le fichier" />
	</form>

<?php $this->stop('main_content'); ?>