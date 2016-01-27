<?php $this->layout('choristes', ['title' => 'CrescendO : News', 'layout' => $layout ]); ?>


<?php $this->start('main_content'); ?>
	<main>
		<?php //echo "<pre>"; print_r($data);?>
		<?php 
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