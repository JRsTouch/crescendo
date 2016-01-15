<?php $this->layout('layout', ['title' => 'Videos !','layout_data' => $data['options'] , 'layout_display' => $layout ]) ?>

<?php $this->start('main_content') ?>

	<div id="player">
		
	</div>
	<ul>
		<?php foreach($videos as $key => $value): ?>

			<li><a class="videos" href="<?= $value['url'] ?>" data-embed="<?= preg_replace('/watch\?v=/', 'v/',  $value['url']) ?>" data-description="<?= $value['description'] ?>"><?= $value['titre'] ?></a></li>

		<?php endforeach ?>
	</ul>

	


<?php $this->stop('main_content') ?>
