<?php $this->layout('choristes', ['title' => 'Ajout de News', 'layout' => $layout ]); ?>

<?php $this->start('main_content');  ?>
	<main>
		<?php print_r($data['actus']);?>

	</main>
<?php $this->stop('main_content'); ?>