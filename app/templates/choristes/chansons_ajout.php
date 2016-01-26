<?php $this->layout('choristes', ['title' => 'CrescendO : Ajout de chansons', 'layout' => $layout]); ?>

			
<?php $this->start('main_content');  ?>
	<main>	
		<?php 

			if(!$data['update']){
				// Récuperation du formulaire en fonction de l'étape d'enregistrement 
				$this->insert('choristes/chansons_ajout/step-'.$data['count']);

		?>
			<p>Pour modifier une chanson existante, choisissez la chanson dans le menu.</p>
		<?php
			}else {
				if ( $data['song_to_update'] != 'done') {
				// Display du formulaire de mise à jour
				$this->insert('choristes/chansons_ajout/update-song',['song_to_update'=>$data['song_to_update']]);
				} else {
					echo '<p>La chanson à correctement été mise à jour !</p>';
				}
		?>
		 		<p>Pour ajouter une nouvelle chanson, cliquez sur "Gestion chanson" dans le menu.</p>
		<?php
			}
		 ?>
		
 	
	</main>

<?php $this->stop('main_content'); ?>