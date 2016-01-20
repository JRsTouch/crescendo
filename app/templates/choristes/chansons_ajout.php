<?php $this->layout('choristes', ['title' => 'Accueil des choristes !', 'layout_data' => $data['options'][0]['copyrights'], 'layout' => $layout, 'user'=>$data['user'] ]); ?>

<?php $this->start('main_content');  ?>
	<main>	
	
		<!-- Récuperation du formulaire en fonction de l'étape d'enregistrement -->
		<?php $this->insert('choristes/chansons_ajout/step-'.$count); ?>
 	
	</main>

<?php $this->stop('main_content'); ?>