<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('site.php');

//Pour avoir accès à : http://www.jheberg.net/download/6SeZ1J-cw-cw-7z, il faut passer par http://www.jheberg.net/captcha/6SeZ1J-cw-cw-7z
class jhebergnet extends Site{
	
	public function __construct($params){
		parent::__construct($params);
		
		//Nom du site qui publie des liens de ddl.
		$this->nom = "JHeberg";
	}
	
	protected function extraire(){
		//Il est possible d'accéder aux liens de deux manières différentes. Mais l'un doit obligatoirement être utilisé
		$link_download = str_replace("/captcha/", "/download/", $this->lien);
		$link_captcha = str_replace("/download/", "/captcha/", $this->lien);
		
		//Extraction des liens
		$tags = $this->lire($link_download, $link_captcha);
		
		//On passe en revue tous les liens
		foreach ($tags as $tag) {
			if(preg_match('/\/redirect\/.*?/i', $tag->getAttribute('href'))){
				$params = str_replace("/redirect/", "", $tag->getAttribute('href'));
				$params = explode("/", $params);
				
				$this->cURL->gestionnaire("http://www.jheberg.net/redirect-ajax/", array("slug" => $params[0], "host" => $params[1]), "http://www.jheberg.net" . $tag->getAttribute('href'));
			}
		}
		
		//Lecture des codes sources des liens que nous avons précédemment extrait
		foreach($this->cURL->execute() as $code_source){
			$result = stripslashes($code_source);
			
			//On récupère le lien qui se trouve dans le code source qui est censé être le lien final
			preg_match('/"(http[^"]+)"/', $result, $matches, PREG_OFFSET_CAPTURE, 3);

			//Nous avons trouvé le lien final si le tableau comporte plus d'un élément
			if(count($matches) > 1)$this->liens[] = $matches[1][0];
		}
	}
	
}

?>