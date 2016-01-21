<?php $this->layout('choristes', ['title' => 'Ajout de News', 'layout_data' => $data['options'][0]['copyrights'], 'layout' => $layout, 'user' => $data['user'] ]); ?>

<?php $this->start('main_content');  ?>
	<main>
		<?php print_r($actus);?>

	</main>
<?php $this->stop('main_content'); ?>