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

abstract class config extends dvc\config {
	const use_inline_logon = true;
	const auth_db_version = 0.03;

	static function auth_checkdatabase() {
		$dao = new dao\dbinfo(null, self::dataPath());
		$dao->checkVersion('dvc_auth', self::auth_db_version);
	}
}
