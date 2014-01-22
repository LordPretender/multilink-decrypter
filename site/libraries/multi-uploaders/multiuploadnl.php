<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('site.php');

//http://www.multiupload.nl/U7X58TGQR7
class multiuploadnl extends Site {
	
	public function __construct($params){
		parent::__construct($params);
		
		//Nom du site qui publie des liens de ddl.
		$this->nom = "MultiUpload";
	}
	
	protected function extraire(){
		//Extraction des liens
		$tags = $this->lire($this->lien);
		
		//On passe en revue tous les liens
		foreach ($tags as $tag) {
			if($tag->getAttribute('id') == 'dlbutton' || substr(strtolower($tag->getAttribute('id')), 0, 13) == 'downloadhref_'){
				//On ne cherche pas de redirection pour le DDL
				if(count($this -> liens) == 0){
					$this -> liens[] = $tag->getAttribute('href');
				}else{
					$this->cURL->gestionnaire($tag->getAttribute('href'), array(), "", TRUE);
				}
			}
		}
		
		$this->liens = array_merge($this->liens, $this->cURL->get_redirections());
	}
	
}

?>