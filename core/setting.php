<?php

namespace RMLcustomizer\Core;

/**
*
*/
class Setting
{
	const MODULE_NAMESPACE = 'RMLcustomizer\\Modules\\';
	const ROOT_OPTION = 'rml-customizer';

	// Array consist all plugin's option
	private $option;

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

	private function __construct() {

		$this->option[ self::ROOT_OPTION ] = $this->build_list_option();
	}

	public function gg() {

		$zz = $this->convert_classname( 'RMLcustomizer\\Modules\\Contents\\Text\\News\\Between' );
		$kk = $this->make_option_name( 'RMLcustomizer\\Modules\\Contents\\Text\\News\\Between' );
		var_dump( [ $zz, $kk ] );

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
	 * Build list all modules
	 *
	 * @return array
	 */
	private function build_list_option() {

		// Load all existing modules
		$modules = array_merge(
			(new Attributes\Loader_Attributes())->load(),
			(new Contents\Loader_Contents())->load()
		);

		$options_list = array();

		foreach ( $modules as $name ) {
			$classname = (new \ReflectionClass( $name ))->getName();
			$releative_name = substr( $classname, strlen( self::MODULE_NAMESPACE ) );
			$segments = explode( '\\', $releative_name );

			$add_option = function( $list, $item ) use ( &$add_option ) {

				if ( false === is_null( $key = array_shift( $item ) ) ) {

					$option = strtolower( str_replace( '_', '-', $key ) );

					if ( false === array_key_exists( $option, $list ) ) {
						$list[ $option ] = array();
					}

					$list[ $option ] = $add_option($list[ $option ], $item);
					return $list;

				}

				return null;
			};

			$options_list = $add_option($options_list, $segments);
		}

		return $options_list;
	}

	/**
	 * Convert __CLASS__ in a module to array for than extracting his setting
	 *
	 * @param $classname String Full class name, like RMLcustomizer\Modules\Contents\Text
	 * @return Array Full deep path to setting in plugin's setting array
	 */
	public function convert_classname( $classname ) {

		if ( false !== strpos( $classname, self::MODULE_NAMESPACE ) ) {
			$releative_name = substr( $classname, strlen( self::MODULE_NAMESPACE ) );
		} else {
			$releative_name = $classname;
		}

		// Namespace segment separate with '\'
		$segments_name = explode( '\\', $releative_name );

		while ( false === is_null( $param = array_shift( $segments_name ) ) ) {
			$option = strtolower( str_replace( '_', '-', $param ) );

			if ( empty( $segments_name ) ) {
				return array( $option => null );
			}

			return array( $option => $this->convert_classname( implode( '\\', $segments_name ) ) );
		}
	}

	private function make_option_name( $classname ) {
		$releative_name = substr( $classname, strlen( self::MODULE_NAMESPACE ) );
		$option_name = strtolower( str_replace( array( '\\', '_' ), '-', $releative_name ) );

		return $option_name;
	}

		/**
	 * Initialize option's plugin. Trigger when plugin install
	 *
	 * @return bool True if initialization success and false otherwise
	 */
	public function initialize() {

		return add_option( $this->option );
	}


	public function terminate() {

		return delete_option( $this->option );
	}

	public static function retrieve() {

	}

	/**
	 *
	 */
	public function add_page() {

	}
}
