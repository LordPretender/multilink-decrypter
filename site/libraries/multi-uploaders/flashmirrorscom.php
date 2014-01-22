<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('site.php');

//http://flashmirrors.com/files/pgicfsfqraairq7/eula.1028.txt
class flashmirrorscom extends Site{
	
	public function __construct($params){
		parent::__construct($params);
		
		//Nom du site qui publie des liens de ddl.
		$this->nom = "FlashMirrors";
	}
	
	protected function extraire(){
		//Extraction de l'ID du fichier
		$url = str_replace("http://flashmirrors.com/files/", "", $this->lien);
		$temp = explode("/",$url);
		$ID = $temp[0];
		
		//Construction d'une nouvelle URL (utilisée pour charger dynamiquement les liens)
		$url = "http://flashmirrors.com/mirrors/$ID";
		
		//Extraction des liens
		$code = json_decode($this->cURL->simple_execute($url), TRUE); //Du JSON est récupéré
		$liens = $code['mirrors'];
		
		//On passe en revue tous les liens, afin de récupérer une donnée qui servira à générer d'autres liens
		foreach ($liens as $lien) {
			if($lien['link_status'] != 'not_available')$this->cURL->gestionnaire("http://flashmirrors.com/download?data=" . $lien['link_data'], array(), "", FALSE);
		}
		
		//Lecture des codes sources des liens que nous avons précédemment extrait
		foreach($this->cURL->execute(TRUE, TRUE) as $url => $code_source){
			preg_match('#getElementById\(\'ifram\'\)\.src=\'(.*)\'#i', $code_source, $matches);
			
			$this->liens[] = count($matches) > 1 ? $matches[1] : $url;
		}
		
		
	}
	
}

?>