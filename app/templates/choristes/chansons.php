<?php $this->layout('choristes', ['title' => 'CrescendO : Chansons', 'layout' => $layout ]); ?>

<?php $this->start('main_content');  ?>
<main>
	
	<div id="player">
		
	</div>
<?php 

	$pupitre = $data['pupitre'];
	if ($data['chanson'] !=0) {
				
		?>
		<h2><?=$data['chanson']['titre']?></h2>

		<div id="song_switch1">			
			<button type="button" id="section_button" class="on"disabled></button>
			<em>Documents de la voix : <?=$data['pupitre']?></em>
		</div>

		<div id="song_switch2">			
			<button type="button" id="tutti_button" class="off"></button>
			<em>Documents du Tutti de la chanson</em>
		</div>
		
		<div class="clearfix"></div>

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
			<div class="clearfix"></div>

			<fieldset>
				<legend>Informations importantes concernant le morceau :</legend>
				<p><?= $data['chanson']['informations'] ?></p>
			</fieldset>

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
			<div class="clearfix"></div>

			<fieldset>
				<legend>Informations importantes concernant le morceau :</legend>
				<p><?= $data['chanson']['informations'] ?></p>
			</fieldset>

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