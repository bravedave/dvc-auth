<?php
/*
	David Bray
	BrayWorth Pty Ltd
	e. david@brayworth.com.au

	This work is licensed under a Creative Commons Attribution 4.0 International Public License.
		http://creativecommons.org/licenses/by/4.0/
	*/
abstract class sys extends dvc\sys {
	function name() {
		$dao = new dao\settings;
		return ( $dao->getName());

	}

	function lockdown() {
		$dao = new dao\settings;
		return ( $dao->lockdown());

	}

}
