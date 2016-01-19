<?php $this->layout('error', ['title' => 'Créer un nouvel administrateur']) ?>

<?php $this->start('main_content'); ?>
<h1>Erreur 403</h1>
<h2>Vous ne disposez pas des droits suffisant pour accerder à cette partie.</h2>
<a href="<?php echo $this->url('home');?>">Retour à l'accueil</a>
<?php $this->stop('main_content'); ?>
