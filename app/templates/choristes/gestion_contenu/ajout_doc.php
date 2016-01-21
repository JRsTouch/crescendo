<?php $this->layout('choristes', ['title' => 'Accueil des choristes !', 'layout_data' => $data['options'][0]['copyrights'], 'layout' => $layout, 'user'=>$data['user'] ]); ?>

<?php $this->start('main_content');  ?>
	<main>	
		<form enctype="multipart/form-data" action="#" method="post" id="document">

	 		<label> Titre <input type="text" name="titre" value="" placeholder="Titre du document" required></label><br>
	 		Sélectionner le fichier : <input name="document" type="file" /><br>
			<input type="text" name="description" value="" placeholder="description succinte du document"><br>
			
			<button type="submit">Envoyer</button>
		</form>

 	
	</main>

<?php $this->stop('main_content'); ?>