<?php $this->layout('choristes', ['title' => 'Accueil des choristes !', 'layout_data' => $data['options'][0]['copyrights'], 'layout' => $layout ]); ?>

<?php $this->start('main_content');  ?>
	<main>	
		
		<?php
			echo $_SESSION['song']['id'];
			if ($count==0){

				echo "<p>La Chanson à été correctement ajoutée au site !</p>";

			}else{

				$this->insert('choristes/chansons_ajout/step-'.$count); 
			}

		?>
 	
	</main>

<?php $this->stop('main_content'); ?>