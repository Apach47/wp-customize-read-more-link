<?php

namespace RMLcustomizer\Core;

/**
*
*/
class Setting
{
	const MODULE_NAMESPACE = 'RMLcustomizer\\Modules\\';

	// All option must be stored in single array for than sending database only one query
	const ROOT_OPTION = 'rml-customizer';

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

		// $result = $this->initialize();

		// var_dump( array( self::ROOT_OPTION => $this->option ) );
		var_dump( $this->setting_list );

		// $term = $this->terminate();
		// var_dump( $term );

		/**
		 * Все настройки хранятся в БД в виде одного массива
		 * Один запрос к БД - извлечение всех опций с которыми работает плагин
		 * По этой причине класс реализует паттерн Singleton
		 *
		 * Структура массива с настройками строится на основе полный имен классов модулей
		 *
		 */
	}

	/**
	 * Create scaffold for all modules in plugin
	 *
	 * @return array
	 */
	private function scaffolding_options() {

		// Load all existing modules
		$modules = array_merge(
			(new Attributes\Loader_Attributes())->load(),
			(new Contents\Loader_Contents())->load()
		);

		$options_list = array();

		foreach ( $modules as $name ) {
			$classname = (new \ReflectionClass( $name ))->getName();
			$option = $this->class_name_to_option_name( $classname );
			$options_list[ $option ] = null;
		}

		return $options_list;
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
			$this->setting_list[ $option ] = $module->by_default();

			if ( false === update_option( self::ROOT_OPTION, $this->setting_list ) ) {
				throw new \Exception('Update options finished with fail.
					Checking permission the database ');
			}
		}

		return $this->setting_list[ $option ];
	}

	/**
	 *
	 */
	public function add_page() {

	}
}
