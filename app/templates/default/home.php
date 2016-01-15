<?php $this->layout('layout', ['title' => 'Accueil !','layout_data' => $data['options'] , 'layout_display' => $layout ]) ?>

<?php $this->start('main_content') ?>

	<div id="presentation">
		<div class="container">
			<h2>Présentation</h2>

			<?= $data['options'][0]['description'] ?>
			<?= $data['options'][0]['description2'] ?>
			<a href="<?= $this->url('presentation') ?>">En savoir plus</a>

		</div>
	</div>
	
	<section id="actus">
		<div class="container">

			<h2>Actualités de presse</h2>


			<?php
			
			for ($i=0; $i <9 ; $i++) { 
				if( isset ($data['actus'][$i]) ) {
					foreach ($data['actus'] as $i) {
						echo "	<article><h3>".$i['titre'].
								"</h3><img src=\"".$i['url']."\" alt=\"".$i['alt']."\" />".
								"<p>".$i['extrait']."<a href=\""."lien de l'article"."\">Voir l'article</a></p>".
								"</article>";
						
					}
					
				}
			}
			?>
			
			<a href="<?= $this->url('presse') ?>">Plus D'articles</a>

		</div>
	</section>

	<div id="video">
		<div class="container">
			<h2>Vidéos</h2>
			<div class="flexslider" id="slider">
				<ul class="slides">
				<?php foreach ($data['videos'] as $key => $value): ?>
					<li>
						<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="1024" height="616" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">
							<param name="allowFullScreen" value="true" />
							<param name="allowscriptaccess" value="always" />
							<param name="src" value="<?= $value['url'] ?>&amp;hl=fr_FR&amp;fs=1" />
							<param name="allowfullscreen" value="true" />
							<embed type="application/x-shockwave-flash" width="640" height="385" src="<?= preg_replace('/watch\?v=/', 'v/',  $value['url']) ?>&amp;hl=fr_FR&amp;fs=1" allowscriptaccess="always" allowfullscreen="true"></embed>
						</object>
						<p><?= $value['description'] ?></p>
					</li>
				<?php endforeach ?>			
				</ul>
			</div>
			<a href="<?= $this->url('videos') ?>">Toutes les vidéos</a>
		</div>
	</div>

	<div id="photo">
		<div class="container">
			<h2>Photos</h2>
			<div class="flexslide" id="carousel">
				<ul class="slides">
				<?php foreach ($data['images'] as $key => $value): ?>
					<li>
						<img src="<?= $value['url'] ?>" alt="<?= $value['alt'] ?>">
						<p><?= $value['description'] ?></p>
					</li>
				<?php endforeach ?>			
				</ul>
			</div>
		</div>
	</div>

	

	




<?php $this->stop('main_content') ?>
