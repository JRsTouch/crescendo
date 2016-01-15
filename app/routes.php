<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		['POST', '/contact', 'Default#Contact', 'contact'],

		['GET', '/presentation', 'Default#presentation', 'presentation'],
		['GET', '/videos', 'Default#GetAllVideos', 'videos'],
		['GET', '/images', 'Default#GetAllImages', 'images'],


		['GET', '/choristes', 'Choriste#Home', 'choristes_home'],

		['GET', '/presse', 'Default#presse', 'presse' ]

	);