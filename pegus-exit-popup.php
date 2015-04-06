<?php
/**
 * Plugin Name: Pegus Exit Popup
 * Plugin URI: http://www.antoinebrossault.com
 * Description: Ce plugin permet de charger une Exit Popup. Cette Exit popup peut être configuré pour acceuillir des boutons de partages vers (Facebook / Google / Twitter). Elle peut aussi créer un formulaire d'inscription à une newsletter via l'API de Mailchimp. 
 * Version: 0.1
 * Author: Antoine Brossault
 *Author URI: http://www.antoinebrossault.com
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require('pegus.class.php');
require('option-page.php'); 

// Options générales
define('PEGUS_DEBUG', false);

// On ajoute une action sur wp_footer
add_action('wp_footer', 'pegus_exit_popup');

// On ajoute une action pour enregistrer les scripts du plugin
add_action( 'wp_enqueue_scripts', 'pegus_exit_popup_script' );
  
	function pegus_exit_popup_script(){
	  		
	  // On enregiste le script principale
	  wp_register_script('pegus-exit-popup', plugins_url().'/pegus-exit-popup/src/exit.js', array('jquery'),'1.10', true);
	  // On met le script principal à la suite
	  wp_enqueue_script('pegus-exit-popup');
	  // On enregiste le script secondaire en précisant qu'il est dependant de pegus-exit-popup
	  wp_register_script('pegus-exit-popup-script', plugins_url().'/pegus-exit-popup/src/exit-script.js', array('pegus-exit-popup'),'1', true);
	  // On met le script secondaire à la suite
	  wp_enqueue_script('pegus-exit-popup-script');
	}	
// Traduction
// On ajoute une action pour charger la traduction
add_action( 'plugins_loaded', 'pegus_load_textdomain' );

	function pegus_load_textdomain() {
		  load_plugin_textdomain( 'pegus-exit-popup', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
   }
   

  function pegus_exit_popup(){ 

	  	$exitpopup = new pegus();
	  	
	 	$exitpopup->get_exitmessage();

		$exitpopup->set_exitpopup();
		
		var_dump($exitpopup);

  }