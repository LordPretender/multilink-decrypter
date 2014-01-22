<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('site.php');

//http://www.multi-up.net/d/CASUJUNUP
class multiupnet extends Site{
	
	public function __construct($params){
		parent::__construct($params);
		
		//Nom du site qui publie des liens de ddl.
		$this->nom = "Multi-Up";
	}
	
	protected function extraire(){
		//Extraction des liens
		$tags = $this->lire($this->lien);
		
		//On passe en revue tous les liens
		foreach ($tags as $tag) {
			if(preg_match('/\/d\/.*?/i', $tag->getAttribute('href'))){
				$this->cURL->gestionnaire("http://www.multi-up.net" . $tag->getAttribute('href'), array(), "", TRUE);
			}
		}
		
		$this->liens = $this->cURL->get_redirections();
	}
	
}

?>