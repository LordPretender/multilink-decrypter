<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accueil extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->template = __CLASS__;
		
		//Nous aurons besoin de lire et écrire dans la session de l'utilisateur
		$this->load->library('session');
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		//On récupère l'url à décrypter passée dans la session ou par le formulaire (si validé).
		$url = $this->session->userdata('url_decrypter');
		if($url == "" && $_POST)$url = isset($_POST['url']) ? $_POST['url'] : '';
		
		//On supprime la variable de session
		$this->session->unset_userdata(array('url_decrypter' => ''));
		
		//Chargement du champ de l'url à décrypter en fonction du paramètre envoyé dans l'adresse.
		$this->data['form_value'] = $url;
		$this->data['result_extraction'] = "";
		
		//Lecture du domaine de l'URL
		$domaine = str_replace("-", "", echapper(domaine($url)));
		if($domaine != ""){
			//Chargement de la bonne librairie en fonction du domaine
			if(file_exists(APPPATH . "libraries/multi-uploaders/$domaine" . EXT)){
				$librairie = "multi-uploaders/$domaine";
				
			}else{
				$librairie = "multi-uploaders/site";
				$domaine = "site";
			}
			$this->load->library($librairie, array($url));
			
			$this->data['result_extraction'] = $this->$domaine->afficherLiens();
		}
		
		//Gestion de la partie JQuery
		$this->jquery();
		
		//Chargement
		$this->parse();
	}
	
	/**
	 * Utilisé uniquement via AJAX, sert à tester la validité d'un lien via le site urlchecker.net.
	 * Le "echo" sert à renvoyer un nom de classe CSS à l'AJAX à appliquer au bloc qui contient le lien fourni pour prévenir l'utilisateur de sa validité ou non.
	 */
	public function verifier(){
		//Petite sécurité : cette page est interdite si non executée via AJAX.
		if($this->input->isAjax()){
			//Test de validité via le site urlchecker
			$lien = isset($_POST['lien']) ? trim($_POST['lien']) : "";
			
			//Lecture du domaine du lien à tester
			//En effet, dans le cas de MultiUpload, il y a aussi un DDL, donc toujours valide.
			$domaine = domaine($lien);
			if($domaine == 'multiupload.nl'){
				$style = "success";
			}else{
				$style = "";
				$status = "";
				
				//Lecture du code HTML
				$doc = new DOMDocument();
				@$doc->loadHTML($this->curl->simple_execute("http://urlchecker.net/", array("links" => $lien)));

				//On ne garde que les liens
				$tags = $doc->getElementsByTagName('a');
				foreach ($tags as $tag) {
					if($tag->getAttribute('href') == $lien && ($tag->getAttribute('class') == 'offline' || $tag->getAttribute('class') == 'live')){
						$style = str_replace("offline", "error", $tag->getAttribute('class'));
						$style = str_replace("live", "success", $style);
					}
				}
			}
			
			echo json_encode($style);
		}else{
			redirect();
		}
	}
	
	/**
	 * Cette méthode sert à construire le code javascript qui permettra de gérer le test de validité des liens.
	 */
	private function jquery(){
		//Chargement de la librairie...
		$this->load->library('javascript');
		
		//Construction du code pour le callback de l'execution du script PHP
			//Mise en évidence, en rouge ou en vert, du bloc où se trouve le lien cliqué.
			$this->javascript->remplirFonction("$('.notification:eq(' + index + ')').addClass(output_string);");
			
			//On masque le lien cliqué
			$this->javascript->remplirFonction("$(self).hide();");
			
			//Compilation...
			$callback = $this->javascript->compileFonction();
		
		//Construction du script principal qui sera exécuté au clic sur un lien de vérification
			//Le this ne fonctionne pas dans le callback, au retour de l'execution de scripts PHP. Il faut donc passer par une variable intermédiaire.
			$this->javascript->remplirFonction("var self = this;");
			
			//On stocke l'index du lien sur lequel l'utilisateur vient de cliquer.
			$this->javascript->remplirFonction("var index = $('.checklink').index(this);");
			
			//On renomme le lien cliqué afin d'informer que la recherche est en cours
			$this->javascript->remplirFonction("$(this).html('[Recherche en cours...]');");
			
			//Execution d'un script PHP avec le callback défini plus tôt.
			$this->javascript->remplirFonction($this->javascript->executerPHP("accueil/verifier", $callback, "{lien: $('.notification:eq(' + index + ') a').attr('href')}"));
		
		//Création de l'évnement sur le clic des liens de vérification
		$this->javascript->click('.checklink', $this->javascript->compileFonction());
		
		//Compilation...
		$this->javascript->external();
		$this->javascript->compile();
		
		//Chargement de variables au moteur TPL
		$this->data['script_foot'] = $this->load->get_var('script_foot');
	}
	
	/**
	 * Cette méthode ne sert qu'à mémoriser en session l'url à décrypter puis d'être redirigé vers l'accueil du site.
	 */
	public function memoriser($encoded_url = ""){
		//On décode l'url  passée en paramètre
		$url = $encoded_url != "" ? base64_decode(implode("/", func_get_args())) : "";
		
		//On enregistre dans la session
		$this->session->set_userdata('url_decrypter', $url);
		
		//Retour à l'accueil
		redirect();
	}
	
	//http://www.dewep.net/Blog/Article-9/Utiliser-cURL-PHP
	//http://www.seoblackout.com/2008/02/13/soumission-automatique-formulaire/
	public function tests(){
		$lien = "http://www.jheberg.net/captcha/fringes05e13finalfrench720pblurayx264-mind-zone-te/";
		
		//Il est possible d'accéder aux liens de deux manières différentes. Mais l'un doit obligatoirement être utilisé
		$link_download = str_replace("/captcha/", "/download/", $lien);
		$link_captcha = str_replace("/download/", "/captcha/", $lien);
		
		$code = $this->curl->simple_execute("http://www.jheberg.net/mirrors/fringes05e13finalfrench720pblurayx264-mind-zone-te/", array(), $lien, TRUE);
		
		echo "1:";
		print_r($code);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */