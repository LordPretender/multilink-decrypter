<?php

class News extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->page_titre = "News";
		$this->meta_desc = "Toutes les dernières informations relatives au site.";
		$this->template = __CLASS__;
		
		//Chargement du Helper qui nous servira à lire le fichier texte.
		$this->load->helper('file');
	}
	
	public function index(){
		//Lecture du fichier texte
		$lignes = explode("\n", read_file('changelog.txt'));
		
		//Affichage de l'actualité
		$this->data["liste_actu"] = ul(str_replace(" : ", " : <br />", $lignes), array());
		
		//Chargement
		$this->parse();
	}
}

?>