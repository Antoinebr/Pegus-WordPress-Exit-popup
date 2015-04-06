<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly Go to hell scripts kiddies
}

class pegus{

	private $exitmessage;
	private $newsletter;
	private $social;
	private $facebook;
	private $twitter;
	private $google;
	private $customhtml;
	
	public function __construct(){

		$this->exitmessage = stripslashes (get_option('exit-message', 'You are leaving ?!'));
		$this->get_newsletter_state();
		$this->set_custom_html();
		if($this->get_social_state()){
		
			$this->set_facebook();
			$this->set_twitter();
			$this->set_google();
		}
	}
	
	public function set_exitpopup($social = null, $newsletter = null){
		?>
	<?php // On link le css ?>
	<link href="<?php echo plugins_url();?>/pegus-exit-popup/src/pegus.css" rel="stylesheet">	
	<?php // On charge le HTML de la popup ?>
	<div data-cookie="true" data-maxamount="<?php echo get_option('exit-maxamount', '1');?>" data-mintime="<?php echo get_option('exit-mintime', '5000');?>" id="pegus-exit" class="pegus_popup">
		<div class="pegus_close" >X</div>
		<div class="pegus_content">
			<?php // Contenu de la popup ?>
			<div class="pegus_title"><?= $this->exitmessage; ?></div>
				
				<?php if($this->newsletter) {$this->get_newsletter();} ?>
				
				<?php // Social ?>
				<?php if ($this->social){
				
					echo '<div class="exit-share-buttons">';
					
							if($this->facebook){$this->get_facebook();}
					
							if($this->twitter){$this->get_twitter();}
					
							if($this->google){$this->get_google();}
							
					echo ' </div>';
				}
				?>
			  <?php // Social Fin ?>
			  <?php if($this->customhtml){ echo $this->get_custom_html();}?>
			<?php // Contenu de la popup Fin ?>	
		</div>
	</div>
	
	<style>
	.pegus_block_layer {background-image: url("<?php echo plugins_url();?>/pegus-exit-popup/images/pattern.png");}
	.pegus_popup {background: <?php echo get_option('exit-background-color', '#ffd752');?>;}
	</style>
	
	<?php
	
	}

	public function get_exitmessage(){
		return $this->exitmessage;
	}
	
	private function get_facebook(){
		?>
		<?php $fb = $this->share_facebook();?>
		<a href="<?php echo $fb['url'];?>" target="<?php echo $fb['target'];?>" onclick="<?php echo $fb['Onclick'];?>">
		<img class="exit-share" src="<?php echo plugins_url();?>/pegus-exit-popup/images/facebook.png">
		</a>		
		<?php
		
	}
	
	private function get_twitter(){
		?>
				<?php $tw = $this->share_twitter();?>
				<a href="<?php echo $tw['url'];?>" 
					target="<?php echo $tw['target'];?>" onclick="<?php echo $tw['Onclick'];?>">
					<img class="exit-share" src="<?php echo plugins_url();?>/pegus-exit-popup/images/twitter.png">
				</a>
		<?php
	}
	
	private function get_google(){
		?>
			<?php $gp = $this->share_google();?>
				<a href="<?php echo $gp['url'];?>" 
					target="<?php echo $gp['target'];?>" onclick="<?php echo $gp['Onclick'];?>">
					<img class="exit-share" src="<?php echo plugins_url();?>/pegus-exit-popup/images/google-plus.png">
				</a>	
		<?php
	}
		
	private function get_social_state(){
		if(get_option('exit-social', 'false') == 'true'){
			$this->social = true;
			return true;
		}else{
			return false;
		}	
	}	
	
	private function set_facebook(){
		if(get_option('exit-social-facebook', 'false') == 'true'){
			$this->facebook = true;
			return true;
		}else{
			return false;
		}	
	}
	
	private function set_twitter(){
		if(get_option('exit-social-twitter', 'false') == 'true'){
			$this->twitter = true;
			return true;
		}else{
			return false;
		}	
	}
	
	private function set_google(){
		if(get_option('exit-social-google', 'false') == 'true'){
			$this->google = true;
			return true;
		}else{
			return false;
		}	
	}
	
	private function share_facebook(){
		$url = get_permalink();
		return $source = array(
					'url'=> 'https://www.facebook.com/sharer/sharer.php?u='.$url,
					'target' => "wclose",
					'Onclick' => "window.open('".$url."','wclose','width=500,height=300,toolbar=no,status=no,left=20,top=30')"
					);
		}

	private function share_google(){
		$url = get_permalink();
		return $source = array(
					'url'=> 'https://plus.google.com/share?url='.$url,
					'target' => "wclose",
					'Onclick' => "window.open('".$url."','wclose','width=500,height=300,toolbar=no,status=no,left=20,top=30')"
					);
	}
	
	
	private function share_twitter(){
		if (!isset($url,$text,$hastag)){
		$url = get_permalink();
		$text = get_the_title();
		$hashtag = "";
		}
		$url_twitter = 'http://twitter.com/share?url='.$url.'&text='.$text.'&hashtags='.$hashtag.'';
		
		return $source = array(
					'url'=> $url_twitter,
					'target' => "wclose",
					'Onclick' => "window.open('".$url."','wclose','width=500,height=300,toolbar=no,status=no,left=20,top=30')"
					);
	}
	
	private function get_newsletter_state(){
		if(get_option('exit-newsletter', 'false') == 'true'){
			$this->newsletter = true;
			return true;
		}else{
			return false;
		}
	}
	
	public function get_newsletter_api(){
		if($this->newsletter){
			return get_option('exit-newsletter-api', '');
		}
	}

	public function get_newsletter_list(){
		if($this->newsletter){
			return get_option('exit-newsletter-list-id', '');
		}
	}
	
	private function get_newsletter(){
		?>
		<div id="pegus-newsletter-form">
			<input type="hidden" id="pegus-nonce" name="pegusnonce" value="<?php echo wp_create_nonce('pegus-newsletter-noncename');?>">
			<input id='permalink' type="hidden" value="<?= plugins_url(); ?>">
			<input type="email" id="newsletter-email" placeholder="<?php _e('Enter your email','pegus-exit-popup'); ?>" value="" class="" required>
			<button id="pegus-newsletter-button" type="submit" class="pegus-newsletter-button">
				<?php _e('subscribe','pegus-exit-popup');  ?>
			</button>
			<div id="pegus-message"></div>
		</div>
		<?php
	}
	
	private function set_custom_html(){
		if(get_option('exit-html', 'false') == 'true'){
			$this->customhtml = true;
			return true;
		}else{
			return false;
		}
	}
	
	private function get_custom_html(){
		if($this->customhtml){
			return stripcslashes(get_option('exit-html-content', ''));
		}
	}

}