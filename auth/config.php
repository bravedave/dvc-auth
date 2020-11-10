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
	static $WEBNAME = 'A PSR style PHP Framework';

	const use_inline_logon = TRUE;
	const auth_db_version = 0.03;

	static protected $_AUTH_VERSION = 0;

	static function auth_checkdatabase() {
		if ( self::auth_version() < self::auth_db_version) {
			self::auth_version( self::auth_db_version);

			$dao = new dao\dbinfo;
			$dao->dump( $verbose = false);

		}

		// sys::logger( 'bro!');

	}

	static function auth_config() {
		return sprintf( '%s%sauth.json', rtrim( self::dataPath(), '/ '), DIRECTORY_SEPARATOR);

	}

	static function auth_init() {
		if ( file_exists( $config = self::auth_config())) {
			$j = json_decode( file_get_contents( $config));

			if ( isset( $j->auth_version)) {
				self::$_AUTH_VERSION = (float)$j->auth_version;

			};

		}

	}

	static protected function auth_version( $set = null) {
		$ret = self::$_AUTH_VERSION;

		if ( (float)$set) {
			$config = self::auth_config();

			$j = file_exists( $config) ?
				json_decode( file_get_contents( $config)):
				(object)[];

			self::$_AUTH_VERSION = $j->auth_version = $set;

			file_put_contents( $config, json_encode( $j, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

		}

		return $ret;

	}

}

config::auth_init();
