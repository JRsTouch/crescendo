<form action="#" method="POST" accept-charset="utf-8">
			<fieldset>
				<legend>Modification de la chanson : <?= $song_to_update['titre']?></legend>
				<label>Lien de la chorégraphie Youtube :<input type="text" name="choregraphy" value="<?=$song_to_update['choregraphie']?>"></label>
				<label>Informations concernant la chanson :<textarea name="informations"><?= $song_to_update['informations'] ?></textarea></label>
				<input type="hidden" name="song_id" value="<?= $song_to_update['id'] ?>">
				<button type="submit" name="update" value="update">Mettre à jour</button>
			</fieldset>
</form>