<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

namespace dao;

use dvc\dao\_dao;

class settings extends _dao {
	protected $_db_name = 'settings';

	protected static $_dto;

	function getFirst() {
		if ( $res = $this->Result( "SELECT * FROM settings"))
			return ( $res->dto());

		return ( false);

	}

	function getName() {

		if ( !self::$_dto) self::$_dto = $this->getFirst();

		if ( self::$_dto)
			return ( self::$_dto->name);

		return ( \config::$WEBNAME);

	}

	function lockdown( $set = NULL) {
		$lockdown = FALSE;

		if (!self::$_dto) self::$_dto = $this->getFirst();

		if ( self::$_dto) {
			$lockdown = (int)self::$_dto->lockdown;

			if ( !is_null( $set)) {
				$this->Q( sprintf( "UPDATE `settings` SET `lockdown` = %d", (int)$set));
				self::$_dto->lockdown = (int)$set;

			}

		}

		//~ \sys::logger( sprintf( 'lockdown = %s', ( $lockdown ? 'TRUE' : 'FALSE' )));

		return ( $lockdown);

	}

}
