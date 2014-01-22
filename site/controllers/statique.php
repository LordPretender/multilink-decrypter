<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statique extends MY_Controller {
	public function a_propos($page = ""){
		$this->template = $page;
		$this->page_titre = "À propos - ";
		
		switch($page){
			case 'le_site':
				$this->meta_desc = "Présentation du service proposé par le site MultiLinks-Decrypter.";
				$this->page_titre .= "Le site";
				break;
				
			case 'le_fonctionnement':
				$this->meta_desc = "Comment fonctionne le site et comment a-t-il été conçu ?";
				$this->page_titre .= "Le fonctionnement";
				break;
				
			case 'utilisation':
				$this->meta_desc = "Comment utiliser le site pour obtenir les liens de téléchargement du fichier souhaité ? Comment tester la validité de ces derniers ?";
				$this->page_titre .= "L'utilisation";
				break;
				
			case 'les_multi_links':
				$this->meta_desc = "Quels sont les sites de Multi-Links actuellement gérés par le site ? Vous retrouver la liste complète.";
				$this->page_titre .= "Le fonctionnement";
				$this->data["multilinks"] = $this->config->item('multilinks');
				
				break;
				
			default:
				redirect("statique/a_propos/le_site");
				break;
		}
		
		//Chargement
		$this->parse();
	}
	
	public function dons(){
		//Configurations pour la page en cours
		$this->template = "dons";
		$this->meta_desc = "Page permettant de faire un don au webmaster. Si vous appréciez ce site, n'hésitez pas !";
		$this->page_titre = "Dons";
		
		//Chargement
		$this->parse();
	}
}
?>