<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('site.php');

//http://go4up.com/dl/15buqEyHOBrO
class go4upcom extends Site {
	
	public function __construct($params){
		parent::__construct($params);
		
		//Nom du site qui publie des liens de ddl.
		$this->nom = "Go4Up";
	}
	
	protected function extraire(){
		//Extraction des liens
		$tags = $this->lire($this->lien);
		
		//On passe en revue tous les liens
		foreach ($tags as $tag) {
			if($tag->getAttribute('class') == 'dl')$this->cURL->gestionnaire($tag->getAttribute('href'), array(), "", TRUE);
		}
		
		//Lecture des codes sources des liens que nous avons précédemment extrait
		$this->liens = $this->cURL->get_redirections();
	}
	
}

?>