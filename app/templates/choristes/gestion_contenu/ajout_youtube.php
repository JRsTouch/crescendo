<?php $this->layout('choristes', ['title' => 'Accueil des choristes !', 'layout_data' => $data['options'][0]['copyrights'], 'layout' => $layout, 'user' => $data['user'] ]); ?>


<?php $this->start('main_content');  ?>
<main>
	<form action="#" method="post" accept-charset="utf-8" id="youtube">
		<label><input type="text" name="url" value="" placeholder="url de la video YouTube"></label>
		<label><input type="text" name="description" value="" placeholder="description de la vidéo"></label>
		<button type="submit" name="sent">Envoyer</button>
	</form>
</main>
<?php $this->stop('main_content'); ?>