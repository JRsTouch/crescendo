<?php
	
	$w_routes = array(
		// Partie Publique
		['GET', '/', 'Default#home', 'home'],
		['POST', '/contact', 'Default#Contact', 'contact'],
		['GET', '/presentation', 'Default#presentation', 'presentation'],
		['GET', '/videos', 'Default#GetAllVideos', 'videos'],
		['GET', '/images', 'Default#GetAllImages', 'images'],
		['GET', '/presse', 'Default#presse', 'presse' ],

<<<<<<< HEAD
		['GET|POST', '/login', 'Users#Login', 'users_login'],
		['GET', '/inscription', 'Users#Inscription', 'users_inscription'],
		['GET', '/resetpass', 'Users#Reset', 'users_reset'],

		['GET', '/choristes', 'Choristes#Home', 'choristes_home'],

=======
		['GET', '/presse', 'Default#presse', 'presse' ],
		
		// Partie Privée
		['GET', '/choristes', 'Choristes#Home', 'choristes_home'],
		['GET', '/choristes/ajout_news', 'Actus#Ajout', 'ajout_news']
>>>>>>> 7ef8aec5e9c863bed2f9a4b8de387f3605fd3642

	);