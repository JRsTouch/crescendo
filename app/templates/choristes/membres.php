<?php $this->layout('choristes', [ 'title' => 'Membres !', 'layout' => $layout ]); ?>


<?php $this->start('main_content');  ?>


	<p>Basses :</p>
	<div class="pupitre">
	<?php foreach($data['membres'] as $key => $value): ?>
		
		<?php if($value['pupitre'] == 'basse'): ?>
			<div class="membre">
				<figure class="figure">
					<img src="<?= $this->assetUrl($value['avatar']) ?>" alt="avatar" width="150" height="150">
					<div class="infos">
						<div>
							<p><?= $value['email'] ?></p>
							<?php if(isset($value['tel'])): ?>
								<p><?= $value['tel'] ?></p>
							<?php endif ?>								
						</div>
					</div>
					<figcaption><?= $value['username'] ?></figcaption>			
				</figure>
			</div>
		<?php endif ?>

	<?php endforeach ?>
	</div><div class="clearfix"></div>

	<p>Tenor :</p>
	<div class="pupitre">
	<?php foreach($data['membres'] as $key => $value): ?>
		
		<?php if($value['pupitre'] == 'tenor'): ?>
			<div class="membre">
				<figure class="figure">
					<img src="<?= $this->assetUrl($value['avatar']) ?>" alt="avatar" width="150" height="150">
					<div class="infos">
						<div>
							<p><?= $value['email'] ?></p>
							<?php if(isset($value['tel'])): ?>
								<p><?= $value['tel'] ?></p>
							<?php endif ?>									
						</div>
					</div>
					<figcaption><?= $value['username'] ?></figcaption>			
				</figure>
			</div>
		<?php endif ?>

	<?php endforeach ?>
	</div><div class="clearfix"></div>

	<p>Alto :</p>
	<div class="pupitre">
	<?php foreach($data['membres'] as $key => $value): ?>
		
		<?php if($value['pupitre'] == 'alto'): ?>
			<div class="membre">
				<figure class="figure">
					<img src="<?= $this->assetUrl($value['avatar']) ?>" alt="avatar" width="150" height="150">
					<div class="infos">
						<div>
							<p><?= $value['email'] ?></p>	
							<?php if(isset($value['tel'])): ?>
								<p><?= $value['tel'] ?></p>
							<?php endif ?>								
						</div>
					</div>
					<figcaption><?= $value['username'] ?></figcaption>			
				</figure>
			</div>
		<?php endif ?>

	<?php endforeach ?>
	</div><div class="clearfix"></div>

	<p>Soprane1 :</p>
	<div class="pupitre">
	<?php foreach($data['membres'] as $key => $value): ?>
		
		<?php if($value['pupitre'] == 'soprane1'): ?>
			<div class="membre">
				<figure class="figure">
					<img src="<?= $this->assetUrl($value['avatar']) ?>" alt="avatar" width="150" height="150">
					<div class="infos">
						<div>
							<p><?= $value['email'] ?></p>
							<?php if(isset($value['tel'])): ?>
								<p><?= $value['tel'] ?></p>
							<?php endif ?>									
						</div>
					</div>
					<figcaption><?= $value['username'] ?></figcaption>			
				</figure>
			</div>
		<?php endif ?>

	<?php endforeach ?>
	</div><div class="clearfix"></div>

	<p>Soprane2 :</p>
	<div class="pupitre">
	<?php foreach($data['membres'] as $key => $value): ?>
		
		<?php if($value['pupitre'] == 'soprane2'): ?>
			<div class="membre">
				<figure class="figure">
					<img src="<?= $this->assetUrl($value['avatar']) ?>" alt="avatar" width="150" height="150">
					<div class="infos">
						<div>
							<p><?= $value['email'] ?></p>
							<?php if(isset($value['tel'])): ?>
								<p><?= $value['tel'] ?></p>
							<?php endif ?>									
						</div>
					</div>
					<figcaption><?= $value['username'] ?></figcaption>			
				</figure>
			</div>
		<?php endif ?>

	<?php endforeach ?>
	</div><div class="clearfix"></div>

<?php $this->stop('main_content'); ?>