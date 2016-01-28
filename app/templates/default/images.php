
<?php $this->layout('layout', ['title' => 'CrescendO : Images !','layout_data' => $data['options'] , 'layout_display' => $layout ]) ?>


<?php $this->start('main_content') ?>

	<div id="slider" class="view">

		<a id="previous" href="" data-description="" data-alt="" data-index="">previous</a>
		<a id="next" href="" data-description="" data-alt="" data-index="">next</a>

	</div>

	<main>
		<div class="container">
			<div
			  class='fb-share-button'
			  data-href='/images'
			  data-type='button_count'>
			</div>
			<ul class="slider"> <!-- Flexslider JS -->
				<?php foreach($images as $key => $value): ?>

					<li><a class="images" href="<?= $this->assetUrl($value['url']) ?>" data-description="<?= $value['description'] ?>" data-alt="<?= $value['description'] ?>" data-index="<?= $key ?>">
							<?= $value['alt'] ?>
							<img src="<?= $this->assetUrl(preg_replace('/\./', '-thumb.', $value['url'])) ?>" alt="thumbnail">
						</a>
					</li>
					
				<?php endforeach ?>
			</ul>
		
		</div><div class="clearfix"></div>

	</main>


<?php $this->stop('main_content') ?>
