<?php $this->layout('images', ['title' => 'Images !','layout_data' => $data['options'] , 'layout_display' => $layout ]) ?>

<?php $this->start('main_content') ?>

	<div id="slider">
		<a id="previous" href="" data-description="" data-alt="" data-index="">previous</a>
		<a id="next" href="" data-description="" data-alt="" data-index="">next</a>
	</div>
	<ul>
		<?php foreach($images as $key => $value): ?>

			<li><a class="images" href="<?= $value['url'] ?>" data-description="<?= $value['description'] ?>" data-alt="<?= $value['description'] ?>" data-index="<?= $key ?>"><?= $value['alt'] ?></a></li>
			
		<?php endforeach ?>
	</ul>


<?php $this->stop('main_content') ?>
