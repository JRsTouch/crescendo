<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<link rel="shortcut icon" href="<?= $this->assetUrl('img/favicon.ico') ?>" />
	<script src="<?= $this->assetUrl('js/jquery-2.1.4.min.js') ?>"></script>
	<link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<script src="<?= $this->assetUrl('js/login.js') ?>"></script>
	<link href='<?= $this->assetUrl('css/login.css') ?>' rel='stylesheet' type='text/css'>
</head>
<body>

	<?= $this->section('main_content') ?>

</body>
</html>