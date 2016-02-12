<?php

namespace RMLcustomizer\Core;

/**
 *
 */
abstract class Loader
{
	// List was loaded file
	private $list_files_loaded = [];

	protected function __construct() {
	}

	/**
	 * Start loading in modules: attr or content
	 */
	abstract public function load();

	/**
	 * Search and
	 *
	 * @folder string
	 *
	 * @return array
	 */
	protected function search( $folder ) {

		if ( ! is_dir( $folder ) && ! file_exists( $folder ) ) {
			throw new Exception( 'Invalid path', 1 );

		}

		$this->list_files_loaded = $this->seek( $folder );
		return (false === empty( $this->list_files_loaded ));
	}

	private function seek( $folder ) {
		$class_list = array();

		foreach ( new \DirectoryIterator( $folder ) as $file ) {

			if ( $file->isDir() && (true !== $file->isDot()) ) {
				$depth_folder = $folder . DIRECTORY_SEPARATOR . $file->getBasename();
				$class_list[ $file->getBasename() ] = $this->seek( $depth_folder );
				continue;
			} else {

				if ( false === $file->isFile() ) {
					// Only files must be loaded
					continue;
				}
			}

			// File name without .php extension
			$file_name = $file->getBasename( '.php' );

			// Convert file name to class name
			$class_name = substr( $file_name, 0, 1 );

			for ( $position = 1; $position < strlen( $file_name ); $position++ ) {
				if ( '-' === $file_name[ $position ] ) {
					if ( ($position + 1) < strlen( $file_name ) ) {
						$class_name .= '_' . strtoupper( $file_name[ $position + 1 ] );
						$position++;
						continue;
					}
				}

				$class_name .= $file_name[ $position ];
			}

			// One file is one class
			$class_list[ $folder . DIRECTORY_SEPARATOR . $file->getBasename() ] = ucfirst( $class_name );
		}

		return $class_list;
	}

	protected function init( $namespace_loaded, $basic_type, $list_loaded = null ) {
		$result = [];

		if ( is_null( $list_loaded ) ) {
			$list_loaded = $this->list_files_loaded;
		}

		foreach ( $list_loaded as $sub_namespace => $class_name ) {

			if ( is_array( $class_name ) ) {
				$full_namespace = $namespace_loaded . ucfirst( $sub_namespace ) . '\\';
				$result = array_merge( $result, $this->init( $full_namespace, $basic_type, $class_name ) );
				continue;
			}

			$full_class_name = $namespace_loaded . $class_name;
			$loaded_object = new $full_class_name;

			if ( $loaded_object instanceof $basic_type ) {
				if ( $loaded_object->active() ) {
					$result[] = $loaded_object;
				}
			} else {
				unset( $loaded_object );
			}
		}

		return $result;
	}
}
