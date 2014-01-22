<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('site.php');

//http://exoshare.com/download.php?uid=1AFZRFPV
class exosharecom extends Site{
	
	public function __construct($params){
		parent::__construct($params);
		
		//Nom du site qui publie des liens de ddl.
		$this->nom = "ExoShare";
	}
	
	protected function extraire(){
		//Avec ExoShare, les liens doivent être extraits ailleurs;
		$url = str_replace("download", "status", $this->lien);
		
		//Extraction des liens
		$tags = $this->lire($url);
		
		//On passe en revue tous les liens
		foreach ($tags as $tag) {
			$this->liens[] = $tag->getAttribute('href');
		}
	}
	
}

?>