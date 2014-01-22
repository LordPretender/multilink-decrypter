<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cURL {
	private $mh;
	private $curl_array;
	private $useragent;
	
	public function __construct(){
		//Création du gestionnaire multiple cURL
		$this->mh = curl_multi_init();
		
		//Contiendra les ressources cUrl
		$this->curl_array = array();
		
		$this->useragent = "Mozilla/5.0";
	}
	
	/**
	 * Cette méthode permet de définir une URL à lire le code source via l'ajout dans la liste des gestionnaires de cURL
	 * 
	 * @access	public
	 * @param	string	URL dont il faut chercher le code source
	 * @param	array	Tableau associatif avec le contenu du formulaire dont il faudra simuler la validation
	 * @param	string	URL qui servira à faire croire que nous venons de cette page.
	 * @return	void
	 */
	public function gestionnaire($url, $postfields = array(), $referer = '', $header = FALSE){
		$clef = $url;
		
		//Création d'une ressource cURL
		$ch = curl_init($url);
		
		//Contenu de formulaires (tableau associatif)
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		
		//On définit un useragent ici Mozilla/5.0
		curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);
		
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		
		//Sert à informer le site que l'on vient de cette page
		curl_setopt($ch, CURLOPT_REFERER, $referer == '' ? $url : $referer);
		
		//Sert pour faire croire que nous exécutons l'url via AJAX
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest"));
		
		//Sert à dire que nous souhaitons avoir l'entête de la page
		if($header)curl_setopt($ch, CURLOPT_HEADER, 1);
		
		//Cette option permet d'indiquer que nous voulons recevoir le résultat du transfert au lieu de l'afficher.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		//Ajout dans le gestionnaire
		curl_multi_add_handle($this->mh, $ch);
		
		//Dans le cas où l'on appelle successivement la même URL, on ajoute un indice à l'URL dans la clef du tableau.
		if(array_key_exists($clef, $this->curl_array))$clef .= "_" . count($this->curl_array);
		
		//Ajout dans le tableau des cURL
		$this->curl_array[$clef] = $ch;
	}
	
	/**
	 * Lance la lecture des codes sources.
	 *
	 * @access	public
	 * @param	boolean	Sert à dire s'il faut convertir ou non le contenu récupéré afin de l'échapper.
	 * @param	boolean	Par défaut, nous n'envoyons que le code source. Mais il est possible de récupérer aussi le lien associé au code source.
	 * @return	array	Tableau simple contenant des codes source ou Tableau associatif avec, en clé, l'url source.
	 */
	public function execute($avecHtmlEntities = FALSE, $avecUrl = FALSE){
		//Execution du gestionnaire
	    $running = NULL; 
	    do { 
	        usleep(10000); 
	        curl_multi_exec($this->mh,$running); 
	    } while($running > 0); 
	    
		//Recupération du code source
	    $res = array();
		foreach($this->curl_array as $url => $ch)$res[$url] = $avecHtmlEntities ? htmlentities(curl_multi_getcontent($ch)) : curl_multi_getcontent($ch); 
	    
		//Fermeture des gestionnaires
	    foreach($this->curl_array as $ch)curl_multi_remove_handle($this->mh, $ch); 
		$this->curl_array = array();
		
		//Devons-nous garder l'URL source à renvoyer ?
		if(!$avecUrl)$res = array_values($res);
		
		//On retourne un tableau de codes source
	    return $res; 
	}
	
	/**
	 * Lecture des URL de redirection ou de l'URL source (si non redirigé)
	 *
	 * @access	public
	 * @return	array	Tableau de liens
	 */
	public function get_redirections(){
		$liens = array();
		
		foreach($this->execute(FALSE, TRUE) as $url => $retour){
			//On cherche l'existence d'une redirection
			preg_match("#location: ([^\n]*)#i" , $retour, $matches);
			
			$liens[] = count($matches) > 1 ? $matches[1] : $url;
		}
		
	    return $liens; 
	}
	
	public function get_redirection($url){
		$this->gestionnaire($url, array(), "", TRUE);
		
		$liens = $this->get_redirections();
		$lien = count($liens) > 0 ? $liens[0] : $url;
		
		return $lien;
	}
	
	/**
	 * Lecture d'un code source.
	 *
	 * @access	public
	 * @param	string	URL dont il faut chercher le code source
	 * @param	array	Tableau associatif avec le contenu du formulaire dont il faudra simuler la validation
	 * @param	string	URL qui servira à faire croire que nous venons de cette page.
	 * @param	boolean	Sert à dire s'il faut convertir ou non le contenu récupéré afin de l'échapper.
	 * @return	string	Code source souhaité
	 */
	public function simple_execute($url, $postfields = array(), $referer = '', $avecHtmlEntities = FALSE){
		//Ajout d'un seul gestionnaire
		$this->gestionnaire($url, $postfields, $referer);
		
		//Puis execution
		$codes = $this->execute($avecHtmlEntities);
		return $codes[0];
	}
}

?>