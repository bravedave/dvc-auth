<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

$dbc = \sys::dbCheck('settings');

$dbc->defineField('name', 'text');
$dbc->defineField('lockdown', 'int');
$dbc->check();

if ($res = $this->db->Result('SELECT count(*) count FROM settings')) {
	if ($dto = $res->dto()) {
		if ($dto->count < 1) {
			$a = ['name' => \config::$WEBNAME];
			$this->db->Insert('settings', $a);

			\sys::logger('wrote system defaults');
		}
	}
}
