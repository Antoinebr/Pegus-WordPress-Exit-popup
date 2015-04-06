<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
// On créer une page d'option

// COLOR PICKER //
add_action( 'admin_enqueue_scripts', 'antoine_color_picker' );
function antoine_color_picker( $hook ) {
 
    if( is_admin() ) { 
     
        // Ajout du Color Picker    
        wp_enqueue_style( 'wp-color-picker' ); 
         
        // Initialisation du script du color Picker
        wp_enqueue_script( 'custom-script-handle', plugins_url( 'src/options.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
    }
}

// COLOR PICKER //
	
add_action('admin_menu', 'antoine_submenu_page');

function antoine_submenu_page() {
	add_submenu_page( 'options-general.php', 'Pegus Exit popup', 'Pegus Exit popup', 'manage_options', 'reglage-exit-popup', 'submenu_exit_popup' );
}

function submenu_exit_popup() {
	if (PEGUS_DEBUG == true){
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
	}
	if(!empty($_POST['antoine_pannel_update'])){
		if(! wp_verify_nonce($_POST['antoine_pannel_noncename'],'antoine_pannel')){
		die('Token non valide');
		}
		 update_option("exit-background-color", $_POST['exit-background-color']);
		 update_option("exit-message", $_POST['exit-message']);
		 update_option("exit-maxamount", $_POST['exit-maxamount']);
		 update_option("exit-mintime", $_POST['exit-mintime']);
		 update_option("exit-newsletter", $_POST['exit-newsletter']);
		 update_option("exit-newsletter-api", $_POST['exit-newsletter-api']);
		 update_option("exit-newsletter-list-id", $_POST['exit-newsletter-list-id']);
		
		 if(empty($_POST['exit-social'])){
		
			  update_option("exit-social", "false");
		 }else{
			 
			 update_option("exit-social", $_POST['exit-social']);
		 }
		 
		 update_option("exit-social-facebook", $_POST['exit-social-facebook']);
		 update_option("exit-social-twitter", $_POST['exit-social-twitter']);
		 update_option("exit-social-google", $_POST['exit-social-google']);
		 
		 update_option("exit-html", $_POST['exit-html']);
		 update_option("exit-html-content", $_POST['exit-html-content']);
		 ?>
		 	<div id="message" class="updated fade">
			 	<p><?php _e('Options successfully saved','pegus-exit-popup'); ?> </p>
		 	</div>
		 <?php
	}
	
	
?>
	<div class="wrap theme-options-page">
		<h2><?php _e('Pegus Exit popup : Settings','pegus-exit-popup'); ?></h2>
		<form action="" method="post">
			<div class="theme-options-group">
				<table cellspacing="0" class="widefat options-table">
					<tbody>
						 <tr>
							<th  scope="row">
								<label for="exit-maxamount"><?php _e('Exit popup message','pegus-exit-popup'); ?></label>
							</th>
							<td>
								<input type="text" id="exit-message" name="exit-message" value="<?php echo stripslashes (get_option('exit-message', ''));?>" size="75" placeholder="<?php _e('Type your message','pegus-exit-popup'); ?>">
							</td>
						</tr>
						 <tr>
							<th  scope="row">
								<label for="exit-background-color"><?php _e('Background Color','pegus-exit-popup'); ?></label>
							</th>
							<td>
								<input type="text" id="exit-background-color" name="exit-background-color" value="<?php echo get_option('exit-background-color', '');?>" class="color-field" />
							</td>
						</tr>
						<tr>
							<th  scope="row">
								<label for="exit-maxamount"><?php _e('Max execution amount','pegus-exit-popup'); ?></label>
							</th>
							<td>
								<input type="text" id="exit-maxamount" name="exit-maxamount" value="<?php echo get_option('exit-maxamount', '');?>" size="75" placeholder="Entrez un nombre">
							</td>
						</tr>
						<tr>
							<th  scope="row">
								<label for="exit-mintime"><?php _e('Min time before execution','pegus-exit-popup'); ?></label>
							</th>
							<td>
								<input type="text" id="exit-mintime" name="exit-mintime" value="<?php echo get_option('exit-mintime', '');?>" size="75" placeholder="<?php _e('Set the time in Ms (5sec = 5000)','pegus-exit-popup'); ?>">
							</td>
						</tr>
						<tr>
							<th  scope="row">
								<label for="mintime"><?php _e('Activate the newsletter Mode','pegus-exit-popup'); ?></label>
							</th>
							<td>
								<input type="checkbox" name="exit-newsletter" value="<?php echo get_option('exit-newsletter', 'false');?>"> <?php _e('Activate Mailchimp','pegus-exit-popup'); ?>
								<fieldset class="show_options_newsletter" style="display:none;">
										<input name="exit-newsletter-api" class="options_newsletter" type="text" placeholder="<?php _e('Enter your MailChimp API key','pegus-exit-popup'); ?>" value="<?php echo get_option('exit-newsletter-api', '');?>" size="75">
								</fieldset>
								<fieldset class="show_options_newsletter" style="display:none;">
										<input name="exit-newsletter-list-id" class="options_newsletter" type="text" placeholder="<?php _e('Enter your MailChimp list ID','pegus-exit-popup'); ?>" value="<?php echo get_option('exit-newsletter-list-id', '');?>">								
								</fieldset>
							</td>
						</tr>
						<tr>
							<th  scope="row">
								<label for="mintime"><?php _e('Activate the social sharing Mode','pegus-exit-popup'); ?></label>
							</th>
							<td>
								<input type="checkbox" name="exit-social" value="true" <?php pegus_checked('exit-social');?>> <?php _e('Activate the social sharing Mode','pegus-exit-popup'); ?>
								<fieldset class="show_options_social" style="display:none;">
									<input type="checkbox" class="exit-social" name="exit-social-facebook" value="true" <?php pegus_checked('exit-social-facebook');?>> Facebook
									<input type="checkbox" class="exit-social" name="exit-social-twitter" value="true" <?php pegus_checked('exit-social-twitter');?>> Twitter
									<input type="checkbox" class="exit-social" name="exit-social-google" value="true" <?php pegus_checked('exit-social-google');?>> Google +
								</fieldset>
							</td>
						</tr>
						<tr>
							<th  scope="row">
								<label for="mintime"><?php _e('Activate the custom HTML mode','pegus-exit-popup'); ?></label>
								<br>
								<small><?php _e('This mode allow you to display any HTML code','pegus-exit-popup'); ?></small>
							</th>
							<td>
							<input type="checkbox" name="exit-html" value="true" <?php pegus_checked('exit-html');?>>
							<?php _e('Activate the HTML mode','pegus-exit-popup'); ?>
							<fieldset class="show_options_html" style="display:none;">
								<textarea name="exit-html-content" class="pegus_textarea" placeholder="<?php _e('Insert here your custom HTML content','pegus-exit-popup'); ?>"><?= stripslashes(get_option('exit-html-content', ''));?></textarea>
							</fieldset>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<input type="hidden" name="antoine_pannel_noncename" value="<?php echo wp_create_nonce('antoine_pannel');?>">
			<p class="submit">
				<input type="submit" name="antoine_pannel_update" class="button-primary autowidth" value="<?php _e('Save','pegus-exit-popup'); ?>">
			</p>
		</form>
	</div>
	
<div class="plugin-credit">
	<p> Plugin by </p>
	<a href="http://antoinebrossault.com" target="_blank">
		<img class="credit-img"src="<?php echo plugins_url();?>/pegus-exit-popup/images/logo-petit.png">
	</a>
</div>

<style>
.plugin-credit{
	float: right;
}

.plugin-credit p,img{
	display: inline-block;
}
.plugin-credit img{
  width: 150px;
  height: auto;
  position: relative;
  top: 13px;
}
.options_newsletter{
	margin-top: 5px;
	margin-bottom: 5px;
}
.show_options_social{
	margin-top: 10px
}

.pegus_textarea{
	margin-top: 10px;
	width: 550px;
	height: 440px;
}

</style>	
	
<?php

}

function pegus_checked($option){
	if(get_option($option) == 'true'){
		echo 'checked';
	}
}


								
