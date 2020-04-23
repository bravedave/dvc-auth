<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class user extends dvc\user {
	var $id = 0;
	protected $dto = false;

	public function __construct() {
		if ( ( $id = (int)session::get('uid')) > 0 ) {
			$dao = new \dao\users;
			if ( $this->dto = $dao->getByID( $id))
				$this->id = $this->dto->id;

		}

	}

	public function valid() {
		/**
		 * if this function returns true you are logged in
		 */

		return ( $this->id > 0);

	}

	public function isadmin() {
		if ( $this->valid()) {
			\sys::logger( sprintf('<%s> %s', $this->dto->admin ? 'admin' : 'not admin', __METHOD__));
			return $this->dto->admin;

		}

		return false;

	}

}
