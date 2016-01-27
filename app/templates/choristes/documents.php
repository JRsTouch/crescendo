<?php $this->layout('choristes', ['title' => 'CrescendO : Téléchargement des documents officiels', 'layout' => $layout ]); ?>

<?php $this->start('main_content'); ?>
	<main>
	
	<h2>Téléchargement des documents officiels</h2>
	
	<p>Cliquez pour visualiser.</p>
	<p>Clic droit ->Enregistrer pour télécharger</p>

	<ul>
		<?php 
			$docs = $layout['docs'];
			foreach ($docs as $doc) {
			echo '<li><a href="'.$this->assetUrl($doc['url']).'" title="'.$doc['description'].'">'.$doc['titre']."</a></li>";
		} ?>
	</ul>

	</main>


<?php $this->stop('main_content'); ?>