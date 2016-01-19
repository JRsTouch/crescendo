<?php
	
	$w_routes = array(
		// Partie Publique
		['GET', '/', 'Default#home', 'home'],
		['POST', '/contact', 'Default#Contact', 'contact'],
		['GET', '/presentation', 'Default#presentation', 'presentation'],
		['GET', '/videos', 'Default#GetAllVideos', 'videos'],
		['GET', '/images', 'Default#GetAllImages', 'images'],
		['GET', '/presse', 'Default#presse', 'presse' ],

		['GET|POST', '/login', 'Users#Login', 'users_login'],
		['GET|POST', '/inscription', 'Users#Register', 'users_inscription'],
		['GET', '/resetpass', 'Users#Reset', 'users_reset'],
		['GET', '/logout', 'Users#Logout', 'users_logout'],
		['GET', '/validate', 'Users#toBeValidate', 'users_Validate'],
		
		// Partie Privée
		['GET', '/choristes', 'Choristes#Home', 'choristes_home'],
		['GET', '/calendar', 'Choristes#Calendar', 'choristes_calendar'],


		['GET|POST', '/choristes/ajout_news', 'Choristes#addNewsActus', 'choriste_ajout_news'],

		['GET', '/choristes/chansons', 'Choristes#Chansons', 'choristes_chansons'],
		['GET', '/choristes/chansons/ajout', 'Choristes#Chansons_Ajout', 'choristes_chansons_ajout'],
		['POST', '/choristes/chansons/ajout', 'Choristes#Chansons_Ajout', 'choristes_chansons_ajoute'],


	);