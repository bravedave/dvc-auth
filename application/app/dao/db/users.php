<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

$dbc = \sys::dbCheck('users');
$dbc->defineField('username', 'text');
$dbc->defineField('name', 'text');
$dbc->defineField('email', 'text');
$dbc->defineField('password', 'text');
$dbc->defineField('admin', 'int');
$dbc->defineField('created', 'text');
$dbc->defineField('updated', 'text');
$dbc->check();

if ($res = $this->db->Result('SELECT count(*) count FROM users')) {
	if ($dto = $res->dto()) {
		if ($dto->count < 1) {
			$a = [
				'username' => 'admin',
				'name' => 'Administrator',
				'password' => password_hash('admin', PASSWORD_DEFAULT),
				'created' => \db::dbTimeStamp(),
				'updated' => \db::dbTimeStamp()
			];

			$this->db->Insert('users', $a);
			\sys::logger('wrote users defaults');
		} else {
			\sys::logger(sprintf('there are %d user(s)', $dto->count));
		}
	}
}
