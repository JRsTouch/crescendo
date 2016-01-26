<?php $this->layout('layout', ['title' => 'CrescendO : Accueil !','layout_data' => $data['options'] , 'layout_display' => $layout ]) ?>

<?php $this->start('main_content') ?>
	
	<!-- Récupération de la présentation globale de la chorale , stockage en BDD -->
	<div id="presentation">
		<div class="container">
			<h2>Présentation</h2>
			<?= $data['options'][0]['description'] ?>
			<?= $data['options'][0]['description2'] ?>
			<?= $data['options'][0]['description3'] ?>
			<?= $data['options'][0]['description4'] ?>
		</div>
	</div>
	
<?php $this->stop('main_content') ?>
