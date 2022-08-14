<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class config extends dvc\config {
  const use_inline_logon = true;

  const dvc_auth_demo_version = 0.1;

  const label = 'Home';

  static function db_checkdatabase() {
    $dao = new dao\dbinfo(null, self::dataPath());
    $dao->checkVersion('dvc_auth_demo', self::dvc_auth_demo_version);
  }
}
