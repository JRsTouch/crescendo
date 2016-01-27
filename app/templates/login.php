<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<script src="<?= $this->assetUrl('js/jquery-2.1.4.min.js') ?>"></script>
	<link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<script src="<?= $this->assetUrl('js/jquery.flexslider.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/login.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/facebook.js') ?>"></script>
	<link href='<?= $this->assetUrl('css/login.css') ?>' rel='stylesheet' type='text/css'>
</head>
<body>

	<?= $this->section('main_content') ?>

</body>
</html>