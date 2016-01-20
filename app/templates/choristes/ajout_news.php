<?php $this->layout('choristes', ['title' => 'Ajout de News']); ?>

<?php $this->start('main_content');  ?>
 	
 	<form enctype="multipart/form-data" action="#" method="post">

 		<select name="table">
 			<option value="Presse">Article</option> <!-- Insertion dans la table correspondante --> 
 			<option value="News">News</option>
 		</select>

 		<label> Titre <input type="text" name="titre" value="" placeholder="Titre de l'article" required></label><br>
 		<label> Description </label><br>
 		<textarea name="description" required></textarea><br>
		Sélectionner le fichier : <input name="my-file" type="file" /><br>

		<input type="text" name="alt" value="" placeholder="description succinte de l'image"><br>
		<input type="text" name="desc_img" value="" placeholder="description complète de l'image"><br>
		Cette information est-elle privée (vue uniquement par les choristes) ? 
		
		<select name="private"> <!-- A mettre en display none en JS si la value du select "table" vaut news -->
 			<option value="1">Oui</option>
 			<option value="0">Non</option>
 		</select>

		<button type="submit" name="sent">Envoyer</button>
	</form>

<?php $this->stop('main_content'); ?>