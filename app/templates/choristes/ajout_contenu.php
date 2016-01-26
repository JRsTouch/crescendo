<?php $this->layout('choristes', ['title' => 'Ajout de contenu', 'layout_data' => $data['options'][0]['copyrights'], 'layout' => $layout, 'user' => $data['user'] ]); ?>


<?php $this->start('main_content');  ?>
<main>
	Quel contenu souhaitez-vous ajouter ?
	<select name="gestionnaire">
		<option value="selection">Selectionnez une option </option>
		<option value="youtube">Contenu Youtube</option>
		<option value="image">Photos</option>
		<option value ="news">News</option>
		<option value="doc">Documents officiels</option>		
	</select>

	<?php if ( isset($upload) && $upload ) {
		echo '<p>Le contenu à correctement été ajouté au site !</p>';
	} ?>

	<form enctype="multipart/form-data" action="#" method="post" id="document">
 		<label> Titre <input type="text" name="titre" value="" placeholder="Titre du document" required></label><br>
 		Sélectionner le fichier : <input name="document" type="file" /><br>
		<input type="text" name="description" value="" placeholder="description succinte du document"><br>
		
		<button type="submit" name="documentsent">Envoyer</button>
	</form>

	
	<form enctype="multipart/form-data" action="#" method="post" id="image">
		<input type="text" name="alt" value="" placeholder="description succinte de l'image" required><br>
		<input type="text" name="desc_img" value="" placeholder="description complète de l'image" required><br>
 		Sélectionner le fichier : <input name="image" type="file" /><br>
				
		<button type="submit" name="imagesent">Envoyer</button>
	</form>

	<form action="#" method="post" accept-charset="utf-8" id="youtube">
		<label><input type="text" name="url" value="" placeholder="url de la video YouTube"></label>
		<label><input type="text" name="description" value="" placeholder="description de la vidéo"></label>
		<button type="submit" name="youtubesent">Envoyer</button>
	</form>

	<form enctype="multipart/form-data" action="#" method="post" id="news">

 		<select name="table">
 			<option value="Selectionnez">Veuillez sélectionner le contenu</option>
 			<option value="Presse">Article</option> <!-- Insertion dans la table correspondante --> 
 			<option value="News">News</option>
 		</select>

 		<label> Titre <input type="text" name="titre" value="" placeholder="Titre de l'article" required></label><br>
 		<label> Description </label><br>
 		<textarea name="description" required></textarea><br>
		Sélectionner le fichier : <input name="my-file" type="file" /><br>

		<input type="text" name="alt" value="" placeholder="description succinte de l'image"><br>
		<input type="text" name="desc_img" value="" placeholder="description complète de l'image"><br>
		<div class="private">Cette information est-elle privée (vue uniquement par les choristes) ?
			<select name="private"> <!-- A mettre en display none en JS si la value du select "table" vaut news -->
	 			<option value="1">Oui</option>
	 			<option value="0">Non</option>
	 		</select>
	 	</div>

		<button type="submit" name="newssent">Envoyer</button>
	</form>


</main>
<?php $this->stop('main_content'); ?>