<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Fonction permettant de générer un menu HTML et de mettre en évidence en élément de ce dernier si le lien correspond à la page en cours.
 */
if ( ! function_exists('site_menu')){
	function site_menu($data, $classe_activename = ''){
		$html = "";
		
		foreach($data as $key => $item){
			$link = $item["link"] == '' ? base_url() : ($item["link"] == '#' ? $item["link"] : site_url($item["link"]));
			$title = $item["title"];
			$sous_menu = !is_null($item["sous_menu"]) && is_array($item["sous_menu"]) ? site_menu($item["sous_menu"], $classe_activename) : '';
			$classe = $classe_activename != '' && ($link == current_url() || strpos($sous_menu, $classe_activename) !== FALSE) ? " class=\"$classe_activename\"" : '';
			
			//Affichage
			$html .= "<li$classe><a href=\"$link\" title=\"$title\">$title</a>$sous_menu</li>";
			
		}
		
		return "<ul>$html</ul>";
	}
}

/**
 * Fonction permettant de récupérer le domaine du lien fourni
 */
if ( ! function_exists('domaine')){
	function domaine($url){
		//Lecture du domaine
		$domaine = parse_url($url, PHP_URL_HOST);
		
		$tab = explode(".", $domaine);
		while(count($tab) > 2)array_shift($tab);
		$domaine = implode(".", $tab);
		
		return strtolower($domaine);
	}
}

/**
 * Fonction permettant de récupérer le domaine du lien fourni
 */
if ( ! function_exists('echapper')){
	function echapper($url){
		$banni = array(".", "-");
		return str_replace($banni, "", $url);
	}
}

/**
 * Header Redirect
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
if ( ! function_exists('redirect')){
	function redirect($uri = '/', $method = 'location', $http_response_code = 302){
		if ( ($uri != '/') && (!preg_match('#^https?://#i', $uri)))$uri = site_url($uri);

		switch($method){
			case 'refresh'	: header("Refresh:0;url=".$uri);
				break;
			default			: header("Location: ".$uri, TRUE, $http_response_code);
				break;
		}
		
		exit;
	}
}

/**
 * Construction d'un lien HTML.
 */
if ( ! function_exists('url')){
	function url($text, $uri = '', $return = FALSE){
		if (! preg_match('#^https?://#i', $uri))$uri = site_url($uri);
		
		$url = '<a href="' . $uri . '">' . $text . '</a>';
		if($return){
			return $url;
		}else{
			echo $url;
		}
	}
}

?>