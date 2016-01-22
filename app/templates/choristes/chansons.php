<?php $this->layout('choristes', ['title' => 'Ajout de News', 'layout' => $layout ]); ?>

<?php $this->start('main_content');  ?>
<main>
	
	<div id="player">
		
	</div>
<?php 

	$pupitre = $data['pupitre'];
	if ($data['chanson'] !=0) {
				
		?>
		<h2><?=$data['chanson']['titre']?></h2>
		<button type="button" id="section_button">Documents de la voix : <?=$data['pupitre']?></button>
		<button type="button" id="tutti_button">Documents du Tutti de la chanson</button>
		<div id="section_song">
			<audio id="audioPlayer" controls="controls" volume>
	    		<source src='<?php echo $data['chanson']["mp3_$pupitre"]?>'>
	    		<source src='<?php echo $data['chanson']["ogg_$pupitre"]?>'>
			</audio>
			<?php
				if (!$data['chanson']['choregraphie']) {
					echo "<p>La chanson n'est pas chorégraphiée</p>";
				} else {
					echo "<a href=".$data['chanson']['choregraphie']." class='choregraphy' data-embed=\"".preg_replace('/watch\?v=/','v/',$data['chanson']['choregraphie'])."\">Regarder la chorégraphie</a>";
				}
			?>
			<p><?= $data['chanson']['informations'] ?></p>

			<object width="1024" height="616">
				<param name="allowFullScreen" value="false" />
				<param name="allowscriptaccess" value="always" />
				<param name="src" value="<?php echo $data['chanson']["pdf_$pupitre"]?>"/>
				<param name="allowfullscreen" value="false" />
				<embed type="application/pdf" width="1024" height="616" src="/<?php echo $data['chanson']["pdf_$pupitre"]?>" allowscriptaccess="always" allowfullscreen="true"></embed>
			</object>
		</div>

		<div id="tutti_song">
			<audio id="audioPlayer" controls="controls" volume>
	    		<source src='<?php echo $data['chanson']["mp3_tutti"]?>'>
	    		<source src='<?php echo $data['chanson']["ogg_tutti"]?>'>
			</audio>
			<?php
				if (!$data['chanson']['choregraphie']) {
					echo "<p>La chanson n'est pas chorégraphiée</p>";
				} else {
					echo "<a href=".$data['chanson']['choregraphie']." class='choregraphy' data-embed=\"".preg_replace('/watch\?v=/','v/',$data['chanson']['choregraphie'])."\">Regarder la chorégraphie</a>";
				}
			?>
			<p><?= $data['chanson']['informations'] ?></p>

			<object width="1024" height="616">
				<param name="allowFullScreen" value="false" />
				<param name="allowscriptaccess" value="always" />
				<param name="src" value="<?php echo $data['chanson']["pdf_tutti"]?>"/>
				<param name="allowfullscreen" value="false" />
				<embed type="application/pdf" width="1024" height="616" src="<?php echo $data['chanson']["pdf_tutti"]?>" allowscriptaccess="always" allowfullscreen="true"></embed>
			</object>
		</div>
		<?php

	}
 ?>
 	
</main>
<?php $this->stop('main_content'); ?>