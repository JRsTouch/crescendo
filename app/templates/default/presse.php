<?php $this->layout('layout', ['title' => 'Articles de presse','layout_data' => $data['options'] , 'layout_display' => $layout ]); //permet d'afficher le layout.php ?> 

<?php $this->start('main_content');//Il faut placer entre start et stop le main content ?>

	<div id="presse">
		<div class="container">
		<?php foreach ($articles as $article) {
			echo "<h3>".$article['titre']."</h3>";
			echo "<p>".$article['description']."</p>";
		}
		?>

		</div>
	</div>

<?php $this->stop('main_content'); ?>
