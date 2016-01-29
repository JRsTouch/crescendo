<?php $this->layout('layout', ['title' => 'CrescendO : News', 'layout_display' => $layout ]); ?>


<?php $this->start('main_content'); ?>
	<main>
		
		<?php 

			/* Si le tableau renvoie un enregistrement de la table NEWS, mise en page du contenu */

			if (!empty($data['news'])) {
				foreach ($data['news'] as $news) {
					echo "<h2>".$news['newstitre']."</h2>";
					echo "<img src='".$this->assetUrl($news['img_url'])."'>";
					echo "<p>".$news['newsdesc']."</p>";
					echo "<p> Parue le ".$news['date']."</p>";
					if($layout['user']['role'] == 'admin' || $layout['user']['role'] == 'chef' || $layout['user']['role'] == 'bureau'){
						echo "<div
						  class='fb-share-button'
						  data-href='/news/".$data['id']."'
						  data-type='button_count'>
						</div>";
					}
				}
			}


			/* Si le tableau renvoie un enregistrement de la table PRESSE, mise en page du contenu */

			if (!empty($data['presses'])) {
				foreach ($data['presses'] as $news) {
					echo "<h2>".$news['newstitre']."</h2>";
					echo "<img src='".$this->assetUrl($news['img_url'])."'>";
					echo "<p>".$news['newsdesc']."</p>";
					echo "<p> Parue le ".$news['date']."</p>";
					if($layout['user']['role'] == 'admin' || $layout['user']['role'] == 'chef' || $layout['user']['role'] == 'bureau'){
						echo "<div
						  class='fb-share-button'
						  data-href='/presses/".$data['id']."'
						  data-type='button_count'>
						</div>";
					}
				}
			} ?>


		
	</main>
<?php $this->stop('main_content'); ?>