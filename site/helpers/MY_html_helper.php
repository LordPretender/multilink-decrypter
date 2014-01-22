<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('notification')){
	function notification($texte, $type = ''){
		return '<p class="notification ' . $type . '" style="margin-bottom: 0px;">' . $texte . '</p>';
	}
}

if ( ! function_exists('notification_success')){
	function notification_success($texte){
		return notification($texte, 'success');
	}
}

if ( ! function_exists('notification_error')){
	function notification_error($texte){
		return notification($texte, 'error');
	}
}

?>