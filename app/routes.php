<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		['GET', '/presentation', 'Default#presentation', 'presentation'],
		['GET', '/videos', 'Videos#GetAllVideos', 'videos'],

		['GET', '/choristes', 'Choriste#Home', 'choristes_home'],
	);