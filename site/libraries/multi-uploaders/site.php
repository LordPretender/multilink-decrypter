<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site {
	protected $nom;
	protected $lien;	//Lien à décrypter
	protected $tester;
	protected $liens;	//Liens extraits du lien à décrypter
	
	protected $inconnu;
	
	protected $CI;
	protected $stockages, $bannis;
	protected $cURL;
	
	public function __construct($params){
		//Nom du site qui publie des liens de ddl.
		$this->nom = "Inconnu";
		$this->inconnu = FALSE;
		$this->lien = $params[0];
		
		//Contiendra les liens de ddl
		$this->liens = array();
		
		//Par défaut, on testera la validité des liens
		$this->tester = TRUE;
		
		//Récupération de variables de CodeIgniter
		$this->CI =& get_instance();
		$this->stockages = $this->CI->config->item('stockages');
		$this->bannis = $this->CI->config->item('bannis');
		
		$this->cURL = $this->CI->curl;
		
		//Extraction des liens
		$this->extraire();
	}
	
	/**
	 * Lecture de la page HTML à la recherche des liens qui s'y trouvent
	 */
	protected function lire($url, $referer = '', $postfields = array()){
		//Lecture du code HTML
		$doc = new DOMDocument();
		@$doc->loadHTML($this->cURL->simple_execute($url, $postfields, $referer));

		//On ne garde que les liens
		$tags = $doc->getElementsByTagName('a');
		
		return $tags;
	}
	
	/**
	 * Via le lien fourni, on va lire la page HTML et récupérer manuellement les liens
	 */
	protected function extraire(){
		//Lecture du domaine du lien qui devait être décrypté
		$domaine = domaine($this->lien);
		
		if($domaine != ''){
			//Si l'url fourni est un lien direct vers une plateforme de stockage, on n'envoie pas de mail
			if(array_key_exists($domaine, $this->stockages)){
				$this->liens[] = $this->lien;
			}else{
				//Dans notre cas, le site n'est pas encore géré.
				//On envoie donc un simple mail au webmaster
				mail($this->CI->config->item('admin_mail'), $this->CI->config->item('site_nom') . " - Site non géré", $this->lien);
				
				$this->inconnu = TRUE;
			}
		}
	}
	
	public function afficherLiens(){
		$html = "";
		
		foreach($this->liens as $lien){
			//Correction de d'adresses...
			$lien = str_replace("uploadhero.co/", "uploadhero.com/", $lien);
			
			$domaine = domaine($lien);
			$texte = array_key_exists($domaine, $this->stockages) ? $this->stockages[$domaine] : $domaine;
			
			//On affiche tous les hosters (sauf ceux bannis).
			if(!in_array($domaine, $this->bannis)){
				$html .= notification(url($texte . ($this->tester ? '<a href="#" class="checklink">[Vérifier]</a>' : ''), $lien, TRUE));
			}
		}
		
		//Mouchard pour le cas où nous ne sommes pas parvenus à extraire de liens.
		if(count($this->liens) < 1 && !$this->inconnu){
			//On envoie donc un simple mail au webmaster
			mail($this->CI->config->item('admin_mail'), $this->CI->config->item('site_nom') . " - Site à problème", $this->lien);
		}
		
		return $html;
	}
	
}

?>