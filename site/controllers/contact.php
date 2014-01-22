<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->page_titre = "Nous contacter";
		$this->meta_desc = "Formulaire d'envoi de mail au webmaster afin d'entrer en contact avec lui.";
		$this->template = __CLASS__;
		
		//Par défaut, pas de message de retour
		$this->data["formulaire_retour"] = '';
	}
	
	//http://www.multilinks-decrypter.fr/contact/success.html
	public function success(){
		$this->data["formulaire_retour"] = notification_success("Votre message a bien été envoyé.");
		
		$this->index();
	}
	
	//http://www.multilinks-decrypter.fr/contact/erreur.html
	public function erreur(){
		$this->data["formulaire_retour"] = notification_error('Votre message n\'a pas été envoyé. Avez-vous bien renseigné votre E-mail et copier-collé le texte demandé ?');
		
		$this->index();
	}
	
	public function index(){
		//Chargement
		$this->parse();
	}
}

?>