<?php $this->layout('layout', ['title' => 'Accueil !']) ?>

<?php $this->start('main_content') ?>
	<header>
		<div class="container">
		<img src="<?= $data['options'][0]['url_logo'] ?>" alt="logo"> <!-- Récupération de l'url dans le tableau data -->

		<h1><?php echo $data['options'][0]['titre']?></h1> <!--  </h1> Récupération du titre dans le tableau data --> 
		<nav>
			<ul>
				<li><a href="#presentation">Présentation</a></li>
				<li><a href="#actus">Actualités</a></li>
				<li><a href="#video">Vidéos</a></li>
				<li><a href="#photo">Photos</a></li>
				<li><a href="#contact">Contact</a></li>
				<li><a href="/choristes">Coin des Choristes</a></li> 
			</ul>
		</nav>

		</div>
	</header><!-- /header -->

	<div id="presentation">
		<div class="container">
		<p><?= substr($data['options'][0]['description'], 0, 825).'...' ?></p>
		<a href="<?= $this->url('presentation') ?>">En savoir plus.</a>
		</div>
	</div>
	
	<section id="actus">
		<div class="container">
			

		</div>
	</section>

	<div id="video">
		<div class="container">
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

	<div id="contact">
		<div class="container">
			

		</div>
	</div>

	<footer>
		<div class="container">
			

		</div>
	</footer>




<?php $this->stop('main_content') ?>
