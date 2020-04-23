<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class logoff extends Controller {
	function __construct() {}

	function index() {
		\session::destroy();
		Response::redirect();

	}

}
