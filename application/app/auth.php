<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

abstract class auth extends dvc\auth {
	static function button() {
		if (auth::GoogleAuthEnabled()) {
			return parent::button();
		} else {
			if (currentUser::valid()) {
				return (sprintf(
					'<a class="nav-link" href="%s"><img alt="logout" src="%s" /><img alt="avatar" class="user-avatar" title="%s" src="%s" /><img alt="logout" src="%s" /></a>',
					url::tostring('logout'),
					url::tostring('images/logout-left9x54.png'),
					currentUser::user()->name,
					currentUser::avatar(),
					url::tostring('images/logout-63x54.png')
				));
			} else {
				return (sprintf('<a class="btn" href="%s">logon</a>', url::tostring()));
			}
		}

		return ('');
	}
}
