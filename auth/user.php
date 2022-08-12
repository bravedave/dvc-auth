<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

namespace dvc\auth;

use dvc, dvc\session;

class user extends dvc\user {
	var $id = 0;
	protected $dto = false;

	public function __construct() {
		if (($id = (int)session::get('uid')) > 0) {
			$dao = new \dao\users;
			if ($this->dto = $dao->getByID($id))
				$this->id = $this->dto->id;
		}
	}

	public function valid() {
		/**
		 * if this function returns true you are logged in
		 */

		if (\sys::lockdown()) {
			\sys::logger(sprintf('<%s> %s', $this->id, __METHOD__));
			return ($this->id > 0);
		}

		return true;
	}

	public function isadmin() {
		if (\sys::lockdown()) {
			if ($this->valid()) {
				// \sys::logger(sprintf('<%s> %s', $this->dto->admin ? 'admin' : 'not admin', __METHOD__));
				return $this->dto->admin;
			}

			return false;
		}

		return true;
	}
}
