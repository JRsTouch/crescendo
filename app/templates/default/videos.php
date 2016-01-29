
<?php $this->layout('layout', ['title' => 'CrescendO : Videos des concerts ! ','layout_data' => $data['options'] , 'layout_display' => $layout ]) ?>


<?php $this->start('main_content') ?>

	<div id="player" class="view">
		
	</div>

	<main>

		<div class="container">


			<ul class="player">

			<?php foreach($videos as $key => $value): ?>

				<li>

					<a class="videos" href="<?= $value['url'] ?>" data-embed="<?= preg_replace('/watch\?v=/', 'v/',  $value['url']) ?>" data-description="<?= $value['description'] ?>"><?= $value['titre'] ?><img src="http://img.youtube.com/vi/<?= substr($value['url'], -11, 11) ?>/mqdefault.jpg" alt="vignette"></a>
					

				</li>

			<?php endforeach ?>
				
			</ul>

		</div><div class="clearfix"></div>
		
	</main>



<?php $this->stop('main_content') ?>
