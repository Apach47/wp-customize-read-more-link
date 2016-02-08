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

		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_styles' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

		$this->initialize();
		$this->run_plugin();
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

		return;
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
	 * Description.
	 *
	 * @return type
	 */
	private function initialize() {

		// $attributes = (new \RMLcustomizer\Core\Attributes\Loader_attributes())->load();
		// var_dump($attributes);
		// var_dump("------------------------------------------");
		// $contents = (new \RMLcustomizer\Core\Contents\Loader_contents())->load();
		// var_dump($contents);
		// exit();
	}

	/**
	 * Place code for your plugin's functionality here.
	 */
	private function run_plugin() {

		// add_filter('excerpt_more', array($this, 'excerpt_more'));
		// global $more;
		// var_dump($more);

		add_action( 'admin_menu', array( $this, 'addMenuInSetting' ) );

		// add_filter('default_excerpt', array($this, 'change_text'));
		// add_filter('excerpt_more', array($this, 'change_text'));
		// add_filter('get_the_excerpt', array($this, 'change_text'));
		// add_filter('the_excerpt', array($this, 'change_text'));
		// add_filter('the_excerpt_embed', array($this, 'change_text'));
		// add_filter('wp_trim_excerpt', array($this, 'change_text'));

		//!!!!
		add_filter( 'the_content_more_link', array( $this, 'disassemble' ), 10, 2 );

		// require_once $this->plugin_path . 'core/binding-link-attribute.php';
		// $rl = new rml_Binding_link_attribute($this->plugin_path);
		// exit("===end===");
	}

	public function disassemble( $link, $text ) {

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

		var_dump( [ $attributes, $contents, $served_link ] );
		exit();
		return $served_link;
	}

	/**
	 * Add menu item admin panel.
	 */
	public function add_menu_in_setting() {

		add_options_page(
			'Customize [Read more...] link',
			'[Read more...] link',
			'manage_options',
			$this->plugin_path.'template/main.php'
		);
	}
}
