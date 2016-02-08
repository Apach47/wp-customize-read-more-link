<?php

namespace RMLcustomizer\Core;

/**
 * Disassemble link from attributes and content.
 */
class Manipulation_Link
{
	const DUMMY_LINK_CONTENT = '%customize_rml%';
	private $link;
	private $text_link;

	public function __construct( $link, $text ) {

		// Content benween <a...> and </a>
		$this->text_link = $text;

		// Ensure than $link have only one link
		if ( false === ((1 === substr_count( strtolower( $link ), '<a' )) && (1 === substr_count( strtolower( $link ), '</a>' )) ) ) {
			throw new \Exception( 'Not found a correct link in the string: '.$link );
		}

		// Remove content in a link
		$this->link = str_replace( $this->text_link, self::DUMMY_LINK_CONTENT, $link );
	}

	/**
	 * @return string
	 */
	public function get_link() {

		return str_replace( self::DUMMY_LINK_CONTENT, $this->text_link, $this->link );
	}

	/**
	 * @return DOMNodeList
	 */
	private function wrap_as_dom_tree() {

		/* Get attributes link **/
		// Wrap link as DOM
		$html_dom = new \DOMDocument();

		/*
         * LIBXML_HTML_NOIMPLIED - Sets it flag, which turns off the automatic adding of implied html/body... elements.
         *
         * LIBXML_HTML_NODEFDTD - Sets it flag, which prevents a default doctype being added when one is not found.
         *
         * Both available in Libxml >= 2.7.8 (as of PHP >= 5.4.0)
         * See more http://php.net/manual/en/libxml.constants.php
         */
		if ( false === $html_dom->loadHTML( $this->link, LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED ) ) {
			// Load was finished with error
			throw new \Exception( 'Error with import link as DomDocument' );
		}

		// Get all nested nodes
		$node_list = $html_dom->getElementsByTagName( 'a' );

		return $node_list;
	}

	/**
	 * Modify or/and add attributes to the link
	 * @return void
	 */
	public function change_attributes( $list_attributes ) {

		try {
			// Work with DOM is easy
			$dom_link = $this->wrap_as_dom_tree( $this->link );

			if ( 1 !== $dom_link->length ) {
				throw new \Exception( 'In the dom was found more then one link' );
			}

			$node_link = $dom_link->item( 0 );

			if ( 'a' !== $node_link->tagName ) {
				throw new \Exception( 'Link not found. Are you serious?!' );
			}

				$attributes_link = $node_link->attributes;

			if ( empty( $attributes_link ) ) {
				throw new \Exception( 'Link doesn\'t have attributes. Is it a nonsense? May be...' );
			}

			// How will being process it attribute
			// Module is a container with custom attribute's setting
			foreach ( $list_attributes as $module ) {
				// Already exist attributes
				for ( $attribute = 0; $attribute < $attributes_link->length; $attribute++ ) {
					$item = $attributes_link->item( $attribute );

					// Update value with exist attribute
					if ( $module->identifier() === $item->name ) {
						$node_link->setAttribute( $item->name, $module->merge( $item->value ) );
						continue;
					}

					// Add new attribute
					$node_link->setAttribute( $module->identifier(), $module->get() );
				}
			}

			// Convert DOM to string
			$this->link = $this->export_to_string( $node_link );

		} catch ( \Exception $err ) {
			throw $err;
		}

	}

	public function change_text( $list_elements ) {
		//Work with DOM is easy
		$dom_text_link = $this->wrap_as_dom_tree($this->text_link);
	}

	/**
	 * Export DomElement object to a string
	 * @return string
	 */
	private function export_to_string( \DOMNode $dom ) {
		try {
			$document = new \DOMDocument();
			$external_node = $document->importNode( $dom, true );
			$document->appendChild( $external_node );
			$save_str = $document->saveHTML();

			return $save_str;
		} catch ( \Exception $err ) {
			return null;
		}
	}

	private function merge( $source, $second ) {

		if ( (false === is_array( $source )) || (false === is_array( $second )) ) {
			throw new Exception( 'Only array must be merged' );
		}

		// First array must to be more then second
		if ( count( $source ) < count( $second ) ) {
			return $this->_merge_attributes( $second, $source );
		}

		$result = array();

		foreach ( $source as $key => $value ) {
			if ( true === array_key_exists( $key, $second ) ) {
				$result[ $key ] = $source[ $key ].' '.$second[ $key ];
				unset( $second[ $key ] );
				continue;
			}

			$result[ $key ] = $value;
		}

		return array_merge( $second, $result );
	}
}
