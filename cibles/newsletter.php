<?php
define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php');

// On verifie le nonce pour eviter une XSFR
if(! wp_verify_nonce($_POST['pegusnonce'],'pegus-newsletter-noncename')){
		die('Token non valide');
}

require_once('mailchimp.class.php');

$exit = new pegus();

$api_key = $exit->get_newsletter_api();

$api_list = $exit->get_newsletter_list();



if(isset($_POST["email"]) && $_POST["email"] !==""){
	$email = $_POST["email"];
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	_e('Invalid email : subscription failed','pegus-exit-popup');  
	die();
	exit();
}



$mailchimp = new MailChimp($api_key);


$result = $mailchimp->call('lists/subscribe', array(
                'id'                => $api_list, // id de la liste
                'email'             => array('email'=>$email),
                //'merge_vars'        => array('FNAME'=>$prenom, 'LNAME'=>$nom),
                'double_optin'      => false,
                'update_existing'   => true,
                'replace_interests' => false,
                'send_welcome'      => false,
            ));

_e('You successfully signed up','pegus-exit-popup'); 

