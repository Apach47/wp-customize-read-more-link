<?php

namespace RMLcustomizer;

/*
 *
 */

class Bootstrap
{
	private static $instance = null;
	private $plugin_path;
	private $plugin_url;
	private $text_domain = '';

	/**
	 * Creates or returns an instance of this class.
	 */
	public static function get_instance() {

		// If an instance hasn't been created and set to $instance create an instance and set it to $instance.
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
	 */
	private function __construct() {

		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_url = plugin_dir_url( __FILE__ );

		load_plugin_textdomain( $this->text_domain, false, $this->plugin_path.'\lang' );

		$this->run_plugin();

		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_styles' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

		add_action( 'admin_menu', array( $this, 'add_menu_in_setting_item' ) );
		add_action( 'admin_init', array( $this, 'setting_init' ) );

		add_filter( 'the_content_more_link', array( $this, 'rebuild_link' ), 10, 2 );

		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

	}

	public function get_plugin_url() {

		return $this->plugin_url;
	}

	public function get_plugin_path() {

		return $this->plugin_path;
	}

	/**
	 * Place code that runs at plugin activation here.
	 */
	public function activation() {
		if ( false === \RMLcustomizer\Core\Setting::get_instance()->initialize() ) {
			// TODO: generate message is activation fail
		}
	}

	/**
	 * Place code that runs at plugin deactivation here.
	 */
	public function deactivation() {

		return;
	}

	/**
	 * Enqueue and register JavaScript files here.
	 */
	public function register_scripts() {

	}

	/**
	 * Enqueue and register CSS files here.
	 */
	public function register_styles() {

	}

	/**
	 * Place code for your plugin's functionality here.
	 */
	private function run_plugin() {

		\RMLcustomizer\Core\Setting::get_instance()->gg();

		// add_filter('excerpt_more', array($this, 'excerpt_more'));
		// global $more;
		// var_dump($more);

		// add_filter('default_excerpt', array($this, 'change_text'));
		// add_filter('excerpt_more', array($this, 'change_text'));
		// add_filter('get_the_excerpt', array($this, 'change_text'));
		// add_filter('the_excerpt', array($this, 'change_text'));
		// add_filter('the_excerpt_embed', array($this, 'change_text'));
		// add_filter('wp_trim_excerpt', array($this, 'change_text'));

		//!!!!

		// require_once $this->plugin_path . 'core/binding-link-attribute.php';
		// $rl = new rml_Binding_link_attribute($this->plugin_path);
		// exit("===end===");
		exit();
	}

	public function rebuild_link( $link, $text ) {

		// Pass original link for processing
		$manipulate = new \RMLcustomizer\Core\Manipulation_Link( $link, $text );

		// Process a attributes
		$attributes = (new \RMLcustomizer\Core\Attributes\Loader_Attributes())->load();
		$manipulate->change_attributes( $attributes );

		// Process a link contents
		$contents = (new \RMLcustomizer\Core\Contents\Loader_Contents())->load();
		$manipulate->change_text( $contents );

		// Link after all transformation
		$served_link = $manipulate->get_link();

		var_dump( [ $contents, $served_link ] );
		exit();
		return $served_link;
	}

	/**
	 * Add menu item admin panel.
	 */
	public function add_menu_in_setting_item() {

		add_options_page(
			'Customize [Read more...] link',
			'[Read more...] link',
			'manage_options',
			// $this->plugin_path.'template/main.php'
			'rml-customize-plugin',
			array( $this, 'rml_option_page' )
		);
	}

	public function rml_option_page() {
		?>
	    <div class="wrap">
	        <h2>My Plugin Options</h2>
	        <form action="options.php" method="POST">
	            <?php settings_fields( 'my-settings-group' ); ?>
	            <?php do_settings_sections( 'rml-customize-plugin' ); ?>
	            <?php submit_button(); ?>
	        </form>
	    </div>
	    <?php
	}

	public function setting_init() {

		register_setting( 'my-settings-group', 'my-setting' );
	    add_settings_section( 'section-one', 'Section One', array( $this, 'section_one_callback' ), 'rml-customize-plugin' );
	    add_settings_field( 'field-one', 'Field One', array( $this, 'field_one_callback' ), 'rml-customize-plugin', 'section-one' );
	}

	public function section_one_callback() {
	    echo 'Some help text goes here.';
	}

	public function field_one_callback() {
	    $setting = esc_attr( get_option( 'my-setting' ) );
	    echo "<input type='text' name='my-setting' value='$setting' />";
	}
}
