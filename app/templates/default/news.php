<?php $this->layout('layout', ['title' => 'CrescendO : News', 'layout_display' => $layout, 'layout_data' => $layout['options'] ]); ?>


<?php $this->start('main_content'); ?>
	<main>
		<?php 
			if (!empty($data['news'])) {
				foreach ($data['news'] as $news) {
				echo "<h2>".$news['newstitre']."</h2>";
				echo "<img src='".$this->assetUrl($news['img_url'])."'>";
				echo "<p>".$news['newsdesc']."</p>";
				echo "<p> Parue le ".$news['date']."</p>";
				}
			}

			if (!empty($data['presses'])) {
				foreach ($data['presses'] as $news) {
					echo "<h2>".$news['newstitre']."</h2>";
					echo "<img src='".$this->assetUrl($news['img_url'])."'>";
					echo "<p>".$news['newsdesc']."</p>";
					echo "<p> Parue le ".$news['date']."</p>";
				}
			} ?>


		
	</main>

<?php $this->stop('main_content'); ?>