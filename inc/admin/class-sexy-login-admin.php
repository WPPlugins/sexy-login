<?php
class Sexy_Login_Admin {
	
	private $page_hook;
	
	public function __construct() {
		
		$this->upgrade();
		
		add_action( 'admin_menu', array( $this, 'add_to_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		
	}
	
	function add_to_menu() {
	
		register_setting( 'sl_options', 'sl_options', array( $this, 'sl_options_validate' ) );
		$this->page_hook	= add_options_page( __( 'Sexy Login Options', 'sl-domain' ), __( 'Sexy Login Options', 'sl-domain' ), 'manage_options', 'sl_options', array( $this, 'sl_options_do_page' ) );
	
	}

	function enqueue_scripts( $hook ) {
	
		if( $hook != $this->page_hook ) 
			return;
		
		wp_register_script( 'sl-admin-js', SL_PLUGIN_ROOT_URL . 'js/admin.js', array( 'jquery' ), '1.0' );
		wp_enqueue_script( 'sl-admin-js' );
		
	}

	function sl_options_do_page() {

		$sl_options			= get_option( 'sl_options' );
		$captcha_enabled	= ( $sl_options['enable_captcha'] ) ? 'block' : 'none';
		$uri 				= parse_url( get_option( 'siteurl' ) );
		?>
		
		<div class="wrap">
		
			<div id="icon-tools" class="icon32"></div>
			
			<h2>Sexy Login Options</h2>
			
			<form method="post" action="options.php">
			
				<?php settings_fields( 'sl_options' ); ?>
				
				<h3><?php esc_html_e( 'General Options', 'sl-domain' ); ?></h3>
				
				<table class="form-table">
					<tbody>
					
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Avatar', 'sl-domain' ); ?></th>
							<td>
								<fieldset>
									<legend class="screen-reader-text"><span><?php esc_html_e( 'Avatar', 'slp-domain' ); ?></span></legend>
									
									<input type="checkbox" name="sl_options[show_avatar]" id="show_avatar" value="1" <?php checked( '1', $sl_options['show_avatar'] ); ?> />
									<label for="show_avatar"><?php esc_html_e( 'Show Avatar', 'sl-domain' ); ?></label>
									<br />
									<input type="number" min="0" max="9999" maxlength="4" size="5" name="sl_options[avatar_size]" id="avatar_size" value="<?php echo esc_attr( $sl_options['avatar_size'] );?>" />
									<label for="avatar_size"><?php esc_html_e( 'Max Avatar Size', 'sl-domain' ); ?></label>
								</fieldset>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'User Buttons', 'sl-domain' ); ?></th>
							<td>
								<fieldset>
									<legend class="screen-reader-text"><span><?php esc_html_e( 'User Buttons', 'slp-domain' ); ?></span></legend>
									
									<input type="checkbox" name="sl_options[show_nickname]" id="show_nickname" value="1" <?php checked( '1', $sl_options['show_nickname'] ); ?> />
									<label for="show_nickname"><?php esc_html_e( 'Show Nickname', 'sl-domain' ); ?></label>
									<br />
									<input type="checkbox" name="sl_options[show_dashboard]" id="show_dashboard" value="1" <?php checked( '1', $sl_options['show_dashboard'] ); ?> />
									<label for="show_dashboard"><?php esc_html_e( 'Show "Dashboard"', 'sl-domain' ); ?></label>
									<br />
									<input type="checkbox" name="sl_options[show_profile]" value="1" id="show_profile" <?php checked( '1', $sl_options['show_profile'] ); ?> />
									<label for="show_profile"><?php esc_html_e( 'Show "Edit My Profile"', 'sl-domain' ); ?></label>
								</fieldset>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Wrap', 'sl-domain' ); ?></th>
							<td>
								<input type="number" min="140" max="9999" maxlength="4" size="5" name="sl_options[wrap_width]" id="wrap_width" value="<?php echo esc_attr( $sl_options['wrap_width'] );?>" />
								<label for="wrap_width"><?php esc_html_e( 'Max-Width', 'sl-domain' ); ?></label>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Registration Settings', 'sl-domain' ); ?></th>
							<td>
								<input type="checkbox" name="sl_options[registration_enabled]" value="1" id="sl-registration-enabled" <?php checked( '1', $sl_options['registration_enabled'] ); ?> />
								<label for="sl-registration-enabled"><?php esc_html_e( 'Enable Registration Form', 'sl-domain' );?></label>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Lost Password Settings', 'sl-domain' ); ?></th>
							<td>
								<input type="checkbox" name="sl_options[lostpwd_enabled]" value="1" id="sl-lostpwd-enabled" <?php checked( '1', $sl_options['lostpwd_enabled'] ); ?> />
								<label for="sl-lostpwd-enabled"><?php esc_html_e( 'Enable Lost Password Form', 'sl-domain' );?></label>
							</td>
						</tr>
					</tbody>
				</table>
				
				<h3><?php esc_html_e( 'Redirects', 'sl-domain' ); ?></h3>
				
				<table class="form-table">
					<tbody>
					
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Login Redirection', 'sl-domain' ); ?></th>
							<td>
								<fieldset>
									<legend class="screen-reader-text"><span><?php esc_html_e( 'Login Redirection', 'slp-domain' ); ?></span></legend>
									
									<input type="radio" name="sl_options[redirect_login]" <?php checked( $sl_options['redirect_login'], 'current' ); ?> value="current" id="sl-redirect-login-current" /><label for="sl-redirect-login-current"><?php esc_html_e( 'Current URL', 'sl-domain' ); ?></label>
									<br />
									<input type="radio" name="sl_options[redirect_login]" <?php checked( $sl_options['redirect_login'], 'custom' ); ?> value="custom" id="sl-redirect-login-custom" /><label for="sl-redirect-login-custom"><?php esc_html_e( 'Custom URL', 'sl-domain' ); ?></label>
									<br />
									<input id="sl-redirect-login-url" type="text" name="sl_options[redirect_login_url]" size="55" value="<?php echo esc_url_raw( $sl_options['redirect_login_url'] ); ?>"  placeholder="<?php esc_attr_e( 'Custom URL to go after login.', 'sl-domain' ); ?>"/>
								</fieldset>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Logout Redirection', 'sl-domain' ); ?></th>
							<td>
								<fieldset>
									<legend class="screen-reader-text"><span><?php esc_html_e( 'Logout Redirection', 'sl-domain' ); ?></span></legend>
									
									<input type="radio" name="sl_options[redirect_logout]" <?php checked( $sl_options['redirect_logout'], 'current' ); ?> value="current" id="sl-redirect-logout-current" /><label for="sl-redirect-logout-current"><?php esc_html_e( 'Current URL', 'sl-domain' ); ?></label>
									<br />
									<input type="radio" name="sl_options[redirect_logout]" <?php checked( $sl_options['redirect_logout'], 'custom' ); ?> value="custom" id="sl-redirect-logout-custom" /><label for="sl-redirect-logout-custom"><?php esc_html_e( 'Custom URL', 'sl-domain' ); ?></label>
									<br />
									<input id="sl-redirect-logout-url" type="text" name="sl_options[redirect_logout_url]" size="55" value="<?php echo esc_url_raw( $sl_options['redirect_logout_url'] ); ?>"  placeholder="<?php esc_attr_e( 'Custom URL to go after log out.', 'sl-domain' ); ?>"/>
								</fieldset>
							</td>
						</tr>
						
					</tbody>
				</table>
				
				<h3><?php echo esc_html( 'ReCaptcha' ); ?></h3>
				
				<input type="checkbox" name="sl_options[enable_captcha]" id="enable-captcha" value="1" <?php checked( '1', $sl_options['enable_captcha'] ); ?> />
				<label for="enable-captcha"><?php esc_html_e( 'Enable Captcha', 'sl-domain' ); ?></label>
								
				<span id="captcha-options" style="display: <?php echo esc_attr( $captcha_enabled ); ?>;">
					<p><?php esc_html_e( 'The next keys are required before you are able to use ReCaptcha. You can get the keys in', 'sl-domain' ); ?> <a href="<?php echo recaptcha_get_signup_url( $uri['host'], 'sexy-login' );?>" target="_blank"><?php echo recaptcha_get_signup_url( $uri['host'], 'sexy-login' ); ?></a>
					<br />
					<strong><?php esc_html_e( 'Note: the keys are not interchangeable.', 'sl-domain' ); ?></strong></p>
					
					<p><label for="recaptcha_public_key"><?php esc_html_e( 'Public Key' ); ?>: </label>
					<input type="text" name="sl_options[recaptcha_public_key]" id="recaptcha_public_key" size="90" value="<?php echo esc_attr( $sl_options['recaptcha_public_key'] )?>" /></p>
					
					<p><label for="recaptcha_private_key"><?php esc_html_e( 'Private Key' ); ?>: </label>
					<input type="text" name="sl_options[recaptcha_private_key]" id="recaptcha_private_key" size="90" value="<?php echo esc_attr( $sl_options['recaptcha_private_key'] )?>" /></p>
				</span>
				
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" />
				</p>
				
			</form>
		
		</div>
		<?php
		
	}

	function sl_options_validate( $input ) {
		
		$input['enable_captcha']		= ( 1 == $input['enable_captcha'] ) ? 1 : 0;
		$input['show_dashboard']		= ( 1 == $input['show_dashboard'] ) ? 1 : 0;
		$input['show_profile']			= ( 1 == $input['show_profile'] ) ? 1 : 0;
		$input['show_avatar']			= ( 1 == $input['show_avatar'] ) ? 1 : 0;	
		$input['registration_enabled']	= ( 1 == $input['registration_enabled'] ) ? 1 : 0;
		$input['show_nickname']			= ( 1 == $input['show_nickname'] ) ? 1 : 0;
		$input['lostpwd_enabled']		= ( 1 == $input['lostpwd_enabled'] ) ? 1 : 0;
		$input['redirect_login']		= ( $input['redirect_login'] == 'custom' && empty( $input['redirect_login_url'] ) ) ? 'current' : $input['redirect_login'];
		$input['redirect_logout']		= ( $input['redirect_logout'] == 'custom' && empty( $input['redirect_logout_url'] ) ) ? 'current' : $input['redirect_logout'];
		$input['redirect_login_url']	=  esc_url_raw( $input['redirect_login_url'] );
		$input['redirect_logout_url']	=  esc_url_raw( $input['redirect_logout_url'] );
		$input['recaptcha_public_key']	=  sanitize_text_field( $input['recaptcha_public_key'] );
		$input['recaptcha_private_key']	=  sanitize_text_field( $input['recaptcha_private_key'] );
		
		$input['avatar_size']			= ( ctype_digit( $input['avatar_size'] ) && $input['avatar_size'] >= 0 ) ? $input['avatar_size'] : 220;
		$input['wrap_width']			= ( ctype_digit( $input['wrap_width'] ) && $input['wrap_width'] >= 140 ) ? $input['wrap_width'] : 240 ;
		
		if ( $input['enable_captcha'] == 1  && ( empty( $input['recaptcha_public_key'] ) || empty( $input['recaptcha_private_key'] ) ) ) {
		
			$input['enable_captcha']	= 0;
			$update_message				= __( 'ReCaptcha was disabled because you have not entered any key', 'sl-domain' );
			add_settings_error( 'general', 'recaptcha', $update_message, 'error');
			
		}

		return $input;
		
	}
	
	function upgrade() {
	
		$config				= get_option( 'sl_config' );
		$current_version	= isset( $config['version'] ) ? $config['version'] : '1.0';

		if ( version_compare( $current_version, SL_VERSION, '==' ) )
			return;
			
		if ( version_compare( $current_version, '2.0', '<' ) ) {
		
			delete_option( 'widget_sexy_login_widget' );
			
			$defaults	= array(
				'enable_captcha'		=> FALSE,
				'recaptcha_public_key'	=> '',
				'recaptcha_private_key'	=> '',
				'show_dashboard'		=> TRUE,
				'show_profile'			=> TRUE,
				'show_avatar'			=> TRUE,
				'avatar_size'			=> 220,
				'wrap_width'			=> 240,
				'redirect_login'		=> 'current',
				'redirect_login_url'	=> '',
				'redirect_logout'		=> 'current',
				'redirect_logout_url'	=> ''
			);
			
			update_option( 'sl_options', $defaults );
			
			global $wpdb;
			
			if( $wpdb->get_var( 'SHOW TABLES LIKE "' . SL_LOGIN_TABLE . '"' ) != SL_LOGIN_TABLE ) {
			
				$create_table	= 'CREATE TABLE ' . SL_LOGIN_TABLE . ' (
					ip varchar(255) NOT NULL,
					last_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
					login_attempts tinyint DEFAULT 1,
					PRIMARY KEY  (ip)
				);';
				$wpdb->query( $create_table );
				
			}

		} // END < 2.0
		
		if ( version_compare( $current_version, '2.1', '<' ) ) {
			
			$options					= get_option( 'sl_options' );
			$options['show_nickname']	= TRUE;
	
			update_option( 'sl_options', $options );
		
		} // END < 2.1
		
		if ( version_compare( $current_version, '2.2', '<' ) ) {
			
			$options							= get_option( 'sl_options' );
			$options['registration_enabled']	= TRUE;
			$options['lostpwd_enabled']			= TRUE;
	
			update_option( 'sl_options', $options );
		
		} // END < 2.2

		$config				= get_option( 'sl_config' );
		$config['version']	= SL_VERSION;
		update_option( 'sl_config', $config );

	}
	
}


?>