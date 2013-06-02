<?php

namespace SMW\Test;

use SMW\CacheHandler;

use HashBagOStuff;

/**
 * Tests for the CacheHandler class
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
 * @since 1.9
 *
 * @file
 * @ingroup Test
 *
 * @licence GNU GPL v2+
 * @author mwjames
 */

/**
 * Tests for the CacheHandler class
 *
 * @ingroup Test
 *
 * @group SMW
 * @group SMWExtension
 */
class CacheHandlerTest extends SemanticMediaWikiTestCase {

	/**
	 * Returns the name of the class to be tested
	 *
	 * @return string
	 */
	public function getClass() {
		return '\SMW\CacheHandler';
	}

	/**
	 * Helper method that returns a CacheHandler object
	 *
	 * @note HashBagOStuff is used as test interface because it stores
	 * content in an associative array (which is not going to persist)
	 *
	 * @return CacheHandler
	 */
	private function getInstance() {
		return new CacheHandler( new HashBagOStuff );
	}

	/**
	 * @test CacheHandler::__construct
	 * @test CacheHandler::getCache
	 *
	 * @since 1.9
	 */
	public function testConstructor() {
		$this->assertInstanceOf( $this->getClass(), $this->getInstance() );
		$this->assertInstanceOf( 'BagOStuff', $this->getInstance()->getCache() );
	}

	/**
	 * @test CacheHandler::newFromId
	 * @test CacheHandler::isEnabled
	 *
	 * @since 1.9
	 */
	public function testNewFromId() {

		// Invoke a valid cacheId
		$instance = CacheHandler::newFromId( 'hash' );
		$this->assertFalse( $instance->isEnabled() ); // No key means false
		$instance->setCacheEnabled( true )->key( 'lala' );
		$this->assertTrue( $instance->isEnabled() ); // An added key results in true

		// Invoke an invalid cacheId
		$instance = CacheHandler::newFromId( 'lula' );
		$this->assertFalse( $instance->isEnabled() ); // No key means false
		$instance->setCacheEnabled( true )->key( 'lila' );
		$this->assertFalse( $instance->isEnabled() ); // An added key but invalid cache results in false

	}

	/**
	 * @test CacheHandler::key
	 * @test CacheHandler::set
	 * @test CacheHandler::get
	 * @test CacheHandler::delete
	 * @test CacheHandler::setCacheEnabled
	 * @dataProvider getDataProvider
	 *
	 * @since 1.9
	 *
	 * @param $key
	 * @param $item
	 */
	public function testEnabledCache( $key, $item ) {
		$instance = $this->getInstance();

		// Assert key handling
		$instance->setCacheEnabled( true )->key( $key );
		$instanceKey = $instance->getKey();

		// Assert storage and retrieval
		$instance->set( $item );
		$this->assertEquals( $item, $instance->get() );

		// Assert deletion
		$instance->delete();
		$this->assertEmpty( $instance->get() );

		$this->assertEquals( $instanceKey, $instance->getKey() );
	}

	/**
	 * @test CacheHandler::key
	 * @test CacheHandler::set
	 * @test CacheHandler::get
	 * @test CacheHandler::delete
	 * @test CacheHandler::setCacheEnabled
	 * @dataProvider getDataProvider
	 *
	 * @since 1.9
	 *
	 * @param $key
	 * @param $item
	 */
	public function testDisabledCache( $key, $item ) {
		$instance = $this->getInstance();

		// Assert key handling
		$instance->setCacheEnabled( false )->key( $key );
		$instanceKey = $instance->getKey();

		// Assert storage and retrieval
		$instance->set( $item );
		$this->assertEmpty( $instance->get() );

		// Assert deletion
		$instance->delete();
		$this->assertEmpty( $instance->get() );

		$this->assertEquals( $instanceKey, $instance->getKey() );
	}

	/**
	 * DataProvider
	 *
	 * @return array
	 */
	public function getDataProvider() {

		// Generates a random key
		$key = $this->getRandomString( 10 );

		// Generates a random text object
		$item = array(
			$this->getRandomString( 10 ),
			$this->getRandomString( 20 )
		);

		return array( array( $key, $item ) );
	}
}