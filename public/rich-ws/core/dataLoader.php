<?php
	
	$current_page=getPage();
	//
	
	//UNE INSTANCE DU Model Pour l'interaction avec la Base de données
	$db = new Model();
	// debug($db)
	// $pages = $db->getPages();//debug($pages);
	$siteinfo = $db->getSiteInfos();//debug($pages);
	
	if($current_page=="index"){
		$sliders = $db->getSliders();
	}
?>