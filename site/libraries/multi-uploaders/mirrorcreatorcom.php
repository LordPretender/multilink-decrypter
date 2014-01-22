<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('site.php');

//http://www.mirrorcreator.com/files/0PJKKG8J/UAV2-12.rar_links
class mirrorcreatorcom extends Site{
	
	public function __construct($params){
		parent::__construct($params);
		
		//Nom du site qui publie des liens de ddl.
		$this->nom = "MirrorCreator";
	}
	
	protected function extraire(){
		//Les liens ne se trouvent pas dans le code source. Ils sont ajoutés via de l'AJAX
		$code = $this->cURL->simple_execute($this->lien);
		
		//On doit récupérer le script PHP exécuté
		preg_match('#(/mstat[^"]+)#i',$code, $matches);
		
		if(count($matches) > 1){
			//Extraction des liens
			$tags = $this->lire("http://www.mirrorcreator.com" . $matches[1]);
			
			//On passe en revue tous les liens
			foreach ($tags as $tag) {
				$this->cURL->gestionnaire("http://www.mirrorcreator.com" . $tag->getAttribute('href'), array(), "", FALSE);
			}
			
			//Lecture des codes sources des liens que nous avons précédemment extrait
			foreach($this->cURL->execute(TRUE, TRUE) as $url => $code_source){
				preg_match('#a href=(.*) TARGET=\'_blank\'#i', $code_source, $matches);
				
				$this->liens[] = count($matches) > 1 ? $matches[1] : $url;
			}
		}
	}
	
}

?>