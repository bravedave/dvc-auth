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

class controller extends dvc\Controller {
	protected function before() {
		config::auth_checkdatabase();
		parent::before();

	}

}
