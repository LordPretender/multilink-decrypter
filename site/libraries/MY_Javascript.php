<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Javascript extends CI_Javascript {
	private $fonction;
	
	public function __construct($params = array()){
		parent::__construct($params);
		
		//Initialisation
		$this->fonction = array();
	}
	
	/**
	 * A utiliser pour renseigner le contenu d'une fonction.
	 */
	public function remplirFonction($ligne){
		$this->fonction[] = $ligne;
	}
	
	/**
	 * Sérialisation de toutes les lignes de la fonction
	 */
	public function compileFonction(){
		//Sérialisation des lignes de la fonction
		$fonction = implode("", $this->fonction);
		
		//On vide pour une prochaine utilisation
		$this->fonction = array();
		
		return $fonction;
	}

	/**
	 * Appel d'un script PHP avec execution de code au retour.
	 */
	public function executerPHP($cible, $callback, $data){
		//Génération du lien
		$cible = site_url($cible);
		
		//Le script php devra retourner des données au format JSON (via json_encode peut être...)
		$retour = "$.ajax({url: '$cible',type:'POST',dataType: 'json', data: $data,success: function(output_string){{$callback}}});";
		
		return $retour;
	}

}

?>