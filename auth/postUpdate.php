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

use application, config, green;
use dvc\service;

class postUpdate extends service {
  protected function _demodata() {
    config::db_checkdatabase();
  }

  protected function _upgrade() {
    config::route_register('users', 'green\\users\\controller');

    green\users\config::green_users_checkdatabase();

    echo (sprintf('%s : %s%s', 'auth updated', __METHOD__, PHP_EOL));
  }

  static function demodata() {
    $app = new self(application::startDir());
    $app->_demodata();
  }

  static function upgrade() {
    $app = new self(application::startDir());
    $app->_upgrade();
  }
}
