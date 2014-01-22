<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('site.php');

//http://www.multiup.org/download/0ed06e5af43d72edcc42cdd1bfce0b68/e8z4gze.part1.rar
//http://www.multiup.org/fichiers/download/e56782d411f0e1baf8f1228c51eb20e6_The.Wire.1x01.vostfr.avi
//http://www.multiup.org/fr/download/e56782d411f0e1baf8f1228c51eb20e6/The.Wire.1x01.vostfr.avi
//http://www.multiup.org/fr/miror/e56782d411f0e1baf8f1228c51eb20e6/The.Wire.1x01.vostfr.avi
class multiuporg extends Site{
	
	public function __construct($params){
		parent::__construct($params);
		
		//Nom du site qui publie des liens de ddl.
		$this->nom = "MultiUp.Org";
	}
	
	protected function extraire(){
		//CAS : http://www.multiup.org/fichiers/download/e56782d411f0e1baf8f1228c51eb20e6_The.Wire.1x01.vostfr.avi
		//Modification du format du lien : http://www.multiup.org/fr/download/e56782d411f0e1baf8f1228c51eb20e6/The.Wire.1x01.vostfr.avi
		if(preg_match('#^http://www.multiup.org/fichiers/download/#i', $this->lien)){			
			$this->lien = str_replace("/fichiers/download/", "/fr/download/", $this->lien);
			$this->lien = preg_replace('#_#i', "/", $this->lien, 1);
		}
		
		//Les liens doivent être extraits ailleurs.
		$url = str_replace("/download/", "/miror/", str_replace("http://www.multiup.org/download/", "http://www.multiup.org/fr/download/", $this->lien));
		
		//Extraction des liens
		$tags = $this->lire($url);
		
		//On passe en revue tous les liens
		foreach ($tags as $tag) {
			if(stripos($tag->getAttribute('class'), 'link host') !== FALSE)$this->liens[] = $tag->getAttribute('href');
		}
	}
	
}

?>