<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class config extends dvc\auth\config {

  const dvc_auth_demo_version = 0.1;

  static function db_checkdatabase() {
    $dao = new dao\dbinfo(null, self::dataPath());
    $dao->checkVersion('dvc_auth_demo', self::dvc_auth_demo_version);
  }
}
