<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="<?= $this->assetUrl('js/jquery.flexslider.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/javascript.js') ?>"></script>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/flexslider.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
</head>
<body>
	
	<?= $this->section('main_content') ?>
		
	
</body>
</html>