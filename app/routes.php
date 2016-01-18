<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		['POST', '/contact', 'Default#Contact', 'contact'],

		['GET', '/presentation', 'Default#presentation', 'presentation'],
		['GET', '/videos', 'Default#GetAllVideos', 'videos'],
		['GET', '/images', 'Default#GetAllImages', 'images'],
		['GET', '/presse', 'Default#presse', 'presse' ],

		['GET|POST', '/login', 'Users#Login', 'users_login'],
		['GET', '/inscription', 'Users#Inscription', 'users_inscription'],
		['GET', '/resetpass', 'Users#Reset', 'users_reset'],

		['GET', '/choristes', 'Choristes#Home', 'choristes_home'],


	);