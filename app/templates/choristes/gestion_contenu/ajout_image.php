<?php $this->layout('choristes', ['title' => 'Accueil des choristes !', 'layout_data' => $data['options'][0]['copyrights'], 'layout' => $layout, 'user'=>$data['user'] ]); ?>

<?php $this->start('main_content');  ?>
	<main>	
		<form enctype="multipart/form-data" action="#" method="post" id="image">
			<input type="text" name="alt" value="" placeholder="description succinte de l'image" required><br>
			<input type="text" name="desc_img" value="" placeholder="description complète de l'image" required><br>
	 		Sélectionner le fichier : <input name="image" type="file" /><br>
					
			<button type="submit" name="sent">Envoyer</button>
		</form>

 	
	</main>

<?php $this->stop('main_content'); ?>