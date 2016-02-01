 
<?php $this->layout('layout', ['title' => 'CrescendO : Articles de presse !','layout_data' => $data['options'] , 'layout_display' => $layout ]); //permet d'afficher le layout.php ?> 

<?php $this->start('main_content');//Il faut placer entre start et stop le main content ?>


	<div id="presse" class="view">
		
	</div>
	
	<main>


		<div class="container">

			<ul>
			<?php foreach ($articles as $article): ?> <!-- display des articles en liste -->
				
				<li>
					<a class="article" href="<?= $article['titre'] ?>" data-description="<?= $article['description'] ?>" data-img="<?= $this->assetUrl($article['url']) ?>">
						<?= $article['titre'] ?>
						<img class="thumbpresse" src="<?= $this->assetUrl(preg_replace('/\./', '-thumb.', $article['url'])) ?>" alt="thumbnail">
					</a>
				</li>
				
			<?php endforeach ?>	

			</ul>

		</div><div class="clearfix"></div>
	</div>

	</main>

<?php $this->stop('main_content'); ?>



