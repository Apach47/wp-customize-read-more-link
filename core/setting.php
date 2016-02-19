<?php

namespace RMLcustomizer\Core;

/**
*
*/
class Setting
{
	// Namespace consist all modules
	const MODULE_NAMESPACE = 'RMLcustomizer\\Modules\\';

	// All option must be stored in single array for than sending database only one query
	const ROOT_OPTION = 'rml-customizer';

	// Option's group for setting's page
	const GROUP_OPTION = 'rml-customizer-all-modules';

	// Slug plugin for admin page
	const ADMIN_PAGE_SLUG = 'rml-customizer-plugin';

	// Array consist all plugin's option
	private $setting_list;

	// Singleton instance
	private static $instance = null;

	/**
	 * Singleton implementation
	 *
	 * @return Setting Instance this object
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	protected function __construct() {

		$this->setting_list = get_option( self::ROOT_OPTION, array() );
	}

	public function gg() {
		$this->settings_init();

		// var_dump( array( self::ROOT_OPTION => $this->option ) );
		// var_dump( $this->setting_list );

		// $term = $this->terminate();
		// var_dump( $term );
	}

	/**
	 * Convert __CLASS__ a module to string without '\' and '_' symbols
	 *
	 * @param $classname String Full class name, like 'RMLcustomizer\Modules\Contents\Text'
	 * @return String Option name, for example 'contents-text'
	 */
	private function class_name_to_option_name( $classname ) {
		$releative_name = substr( $classname, strlen( self::MODULE_NAMESPACE ) );
		$option_name = strtolower( str_replace( array( '\\', '_' ), '-', $releative_name ) );

		return $option_name;
	}

		/**
	 * Plugin options will be add in the database. Triggering when plugin install
	 *
	 * @return bool True if initialization success
	 */
	public function initialize() {

		if ( false === add_option( self::ROOT_OPTION, array() ) ) {
			throw new \Exception( 'Plugin initialization finished with fail. First off, check your database permission ' );
		}

		return true;
	}

	/**
	 * Remove all option from database. Triggering when plugin uninstall
	 *
	 * @return Boolean True if option's list was removed success
	 */
	public function terminate() {

		if ( delete_option( self::ROOT_OPTION ) ) {
			return true;
		}

		throw new \Exception( 'Remove option was finish with fail. You may remove option ' . self::ROOT_OPTION . ' manualy from table\'s database \'wp-option\'' );

	}

	/**
	 * Get options for one module
	 *
	 * @param String Full class name of module
	 * @return Array Option releated specific module
	 */
	public function retrieve( $module ) {

		$classname = (new \ReflectionClass( $module ))->getName();
		$option = $this->class_name_to_option_name( $classname );

		// Loading new module
		if ( false === array_key_exists( $option, $this->setting_list ) ) {
			$this->setting_list[ $option ] = $module->default_value();

			if ( false === update_option( self::ROOT_OPTION, $this->setting_list ) ) {
				throw new \Exception('Update options finished with fail.
					Checking permission the database ');
			}
		}

		return $this->setting_list[ $option ];
	}

	/**
	 * Display setting page in admin area
	 */
	public function admin_page() {

		add_options_page(
			'Customize [Read more...] link',
			'[Read more...] link',
			'manage_options',
			self::ADMIN_PAGE_SLUG,
			function() {
				echo '<div class=\'wrap\'>';
		        echo '<h2>' . __( 'My Plugin Options' ) . '</h2>';
			        echo '<form action=\'options.php\' method=\'POST\'>';
			            settings_fields( self::GROUP_OPTION );
			            do_settings_sections( self::ADMIN_PAGE_SLUG );
			            submit_button();
			        echo '</form>';
			    echo '</div>';
			}
	    );
	}

	public function init() {
		register_setting( self::GROUP_OPTION, self::ROOT_OPTION );

		$list_modules = array(
			(new \RMLcustomizer\Core\Attributes\Loader_Attributes()),
			(new \RMLcustomizer\Core\Contents\Loader_Contents()),
		);

		// Register all section and his fiels in option page
		foreach ( $list_modules as $modules_container ) {

			$section = $modules_container->settings();

			add_settings_section(
				$section['slug'],
				$section['name'],
				function() use ( $section ) {
					return $this->section_hint( $section['desc'] );
				},
				self::ADMIN_PAGE_SLUG
			);

			foreach ( $modules_container->load() as $module ) {

				$field = $module->option_field();
				$id = $this->class_name_to_option_name( $field['slug'] );
				$name = __( str_replace( '%tag%', 'span', $field['name'] ) );
				$type = function() use ( $field, $id ) {
					// TODO: Build list input's type and check 'field_type' with it
					$render = 'input_' . $field['field_type'];

					$arg = array( 'option' => $id, 'desc' => $field['desc'] );
					// TODO: it hot fix
					if ( isset( $field['field_value'] ) ) {
						$arg['value'] = $field['field_value'];
					}

					return $this->$render($arg);
				};

				add_settings_field( $id, $name, $type, self::ADMIN_PAGE_SLUG, $section['slug'] );
			}
		}
	}

	public function section_hint( $hint = 'def' ) {
		echo $hint . ' is work';
	}

	public function input_text( $arg ) {

		$value = esc_attr( $this->setting_list[ $arg['option'] ] );

		$html = sprintf(
			'<input type=\'text\' name=\'%s\' value=\'%s\' />',
			self::ROOT_OPTION . '[' . $arg['option'] . ']', $value
		);

		echo $html;

	}

	public function input_radio( $arg ) {
		$value = esc_attr( $this->setting_list[ $arg['option'] ] );

		$html = '';

		foreach ( $arg['value'] as $item ) {
			$html .= sprintf(
				'<input type=\'radio\' name=\'%s\' value=\'%s\' />',
				self::ROOT_OPTION . '[' . $arg['option'] . ']', $item
			) . sprintf( '<span>%s</span>', $item );
		}

		echo $html;
	}
}
