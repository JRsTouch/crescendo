<?php
	
	$w_routes = array(
		// Partie Publique
		['GET', '/', 'Default#home', 'home'],
		['POST', '/contact', 'Default#Contact', 'contact'],
		['GET', '/presentation', 'Default#presentation', 'presentation'],
		['GET', '/videos', 'Default#GetAllVideos', 'videos'],
		['GET', '/images', 'Default#GetAllImages', 'images'],
		['GET', '/presse', 'Default#presse', 'presse' ],

		// Partie Connexion User
		['GET|POST', '/login', 'Users#Login', 'users_login'],
		['GET|POST', '/inscription', 'Users#Register', 'users_inscription'],
		['GET|POST', '/resetpass', 'Users#Reset', 'users_reset'],
		['GET', '/logout', 'Users#Logout', 'users_logout'],
		['GET', '/validate', 'Users#toBeValidate', 'users_Validate'],
		['GET|POST', '/newpass/[:token]', 'Users#newPass', 'users_newpass'],
		
		// Partie Privée
		
		['GET', '/calendar', 'Choristes#Calendar', 'choristes_calendar'],
		['GET', '/event', 'Choristes#Event', 'choristes_event'],
		['GET|POST', '/modify', 'Choristes#userAccount', 'users_modify'],

		//['GET|POST', '/choristes/ajout_news', 'Choristes#addNewsActus', 'choristes_ajout_news'],

		['GET|POST', '/choristes/chansons/ajout', 'Choristes#Chansons_Ajout', 'choristes_chansons_ajout'],
		['GET|POST', '/choristes/chansons/update/[:id]/[:update]', 'Choristes#Chansons_Ajout', 'choristes_chansons_update'],
				
		['GET', '/choristes/chansons', 'Choristes#Chansons', 'choristes_chansons'],
		['GET', '/choristes/chansons/[:id]', 'Choristes#Chansons', 'choristes_chanson'],

		['GET', '/choristes/actus', 'Choristes#getActus', 'choristes_actus'],
		['GET|POST', '/choristes/gestion_contenu', 'Choristes#gestionContenu', 'choristes_ajout_contenu'],
		['GET|POST', '/choristes/repetitions', 'Choristes#Repetitions', 'choristes_repetitions'],
		['GET', '/choristes/membres', 'Choristes#Membres', 'choristes_membres'],
		['GET', '/choristes', 'Choristes#getActus', 'choristes_actus_nav'],
		['GET', '/choristes/documents_officiels', 'Choristes#getDocs', 'choristes_documents_officiels'],
		['GET|POST', '/choristes/management', 'Choristes#membersManagement', 'choristes_management'],

	);