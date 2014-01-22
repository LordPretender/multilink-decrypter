<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	protected $data;
	
	protected $page_titre;
	protected $meta_desc;
	
	protected $structure;
	protected $template;
	
	public function __construct(){
		parent::__construct();
		$this->structure = "structure";
		
		$this->data = array();
		$this->data["site_nom"] = $this->config->item('site_nom');
		$this->data["meta_keys"] = $this->config->item('site_keys');
		$this->data["assets"] = base_url() . 'assets/';
		$this->data["current_url"] = current_url();
		$this->data['script_foot'] = "";
		
		$this->meta_desc = $this->config->item('site_desc');
	}
	
	private function menu(){
		$a_propos = array();
		$a_propos[] = array("title" => "Le site", "link" => "statique/a_propos/le_site", "sous_menu" => NULL);
		$a_propos[] = array("title" => "Le fonctionnement", "link" => "statique/a_propos/le_fonctionnement", "sous_menu" => NULL);
		$a_propos[] = array("title" => "Les Multi-Links", "link" => "statique/a_propos/les_multi_links", "sous_menu" => NULL);
		$a_propos[] = array("title" => "L'utilisation", "link" => "statique/a_propos/utilisation", "sous_menu" => NULL);
		
		$data = array();
		$data[] = array("title" => "Accueil", "link" => "", "sous_menu" => NULL);
		$data[] = array("title" => "News", "link" => "news", "sous_menu" => NULL);
		$data[] = array("title" => "À propos", "link" => "#", "sous_menu" => $a_propos);
		$data[] = array("title" => "Dons", "link" => "statique/dons", "sous_menu" => NULL);
		$data[] = array("title" => "Nous contacter", "link" => "contact", "sous_menu" => NULL);
		
		return site_menu($data, "current-menu-item");
	}
	
	/**
	 * Parse a template
	 *
	 * @return	string
	 */
	public function parse($return = FALSE){
		
		//http://stackoverflow.com/questions/3225290/best-way-to-include-view-within-view-in-codeigniter-template-using-dwoo
		$this->data["meta_title"] = ($this->page_titre != '' ? $this->page_titre . " | " : "") . $this->config->item('site_nom');
		$this->data["meta_desc"] = $this->meta_desc;
		
		$this->data["menu"] = $this->menu();
		
		//Chargement du contenu
		if($this->template != '')$this->data["contenu"] = $this->parser->parse("page/" . strtolower($this->template), $this->data, TRUE);
		
		return $this->parser->parse($this->structure, $this->data, $return);
	}
}

?>