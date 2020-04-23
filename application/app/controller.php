<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class controller extends dvc\Controller {
	protected function before() {
		config::auth_checkdatabase();
		parent::before();

	}

}
