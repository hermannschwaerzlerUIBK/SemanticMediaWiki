<?php

namespace SMW;

/**
 * Semantic MediaWiki Api Base class
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 *
 * @license GNU GPL v2+
 * @since   1.9
 *
 * @author mwjames
 */

/**
 * Semantic MediaWiki Api Base class
 *
 * @ingroup Api
 * @codeCoverageIgnore
 */
abstract class ApiBase extends \ApiBase implements StoreAccess {

	/** @var Store */
	protected $store = null;

	/**
	 * @see ApiBase::__construct
	 *
	 * @since 1.9
	 *
	 * @param ApiMain $main
	 * @param string $action Name of this module
	 */
	public function __construct( $main, $action ) {
		parent::__construct( $main, $action );
		$this->store = StoreFactory::getStore();
	}

	/**
	 * Sets Store object
	 *
	 * @since 1.9
	 *
	 * @param Store $store
	 */
	public function setStore( Store $store ) {
		$this->store = $store;
		return $this;
	}

	/**
	 * Returns Store object
	 *
	 * @since 1.9
	 *
	 * @return Store
	 */
	public function getStore() {

		if ( $this->store === null ) {
			$this->store = StoreFactory::getStore();
		}

		return $this->store;
	}

}