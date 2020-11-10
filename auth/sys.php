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

use dvc;
use dvc\auth\dao;

abstract class sys extends dvc\sys {
	static function name() {
		$dao = new dao\settings;
		return ( $dao->getName());

	}

	static function lockdown() {
		$dao = new dao\settings;
		return ( $dao->lockdown());

	}

}
