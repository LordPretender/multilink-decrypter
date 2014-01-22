<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('site.php');

//http://www.mirorii.com/rqn91sxtadxv/BKT_Chapitre_536_Mirorii.com.zip
class miroriicom extends Site {
	
	public function __construct($params){
		parent::__construct($params);
		
		//Nom du site qui publie des liens de ddl.
		$this->nom = "Mirorii";
		
		//Il n'est pas possible de récupérer les vrais liens. Il n'est donc pas possible de tester leur validité
		//$this->tester = FALSE;
	}
	
	protected function extraire(){
		//Extraction des liens
		$tags = $this->lire($this->lien);
		
		//On passe en revue tous les liens
		foreach ($tags as $tag) {
			//On garde les liens qui ont qui possèdent le lien comme label
			if($tag->getAttribute('href') == $tag->nodeValue)$this->cURL->gestionnaire($tag->getAttribute('href'), array(), "http://www.mirorii.com/r_counter");
		}
		
		//Lecture des codes sources des liens que nous avons précédemment extrait
		foreach($this->cURL->execute(TRUE) as $code_source){
			//On retransforme les "
			$result = str_replace("&quot;", "\"", $code_source);
			
			//On récupère le lien qui se trouve dans le code source qui est censé être le lien final
			preg_match('/src ?= ?"(http[^"]+)"/', $result, $matches, PREG_OFFSET_CAPTURE, 3);

			//Nous avons trouvé le lien final si le tableau comporte plus d'un élément
			if(count($matches) > 1)$this->liens[] = $matches[1][0];
		}
	}

}

?>