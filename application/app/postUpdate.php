<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class postUpdate extends dvc\service {
  protected function _set_default_password() {
    $dao = new dao\users;
    $dao->Q(sprintf(
      'UPDATE users SET `password` = %s WHERE username = %s',
      $dao->quote(password_hash('admin', PASSWORD_DEFAULT)),
      $dao->quote('admin')
    ));
  }

  protected function _upgrade() {
    config::route_register('users', 'green\\users\\controller');

    config::db_checkdatabase();
    green\users\config::green_users_checkdatabase();

    echo (sprintf('%s : %s%s', 'auth updated', __METHOD__, PHP_EOL));
  }

  static function set_default_password() {
    $app = new self(application::startDir());
    $app->_set_default_password();
  }

  static function upgrade() {
    $app = new self(application::startDir());
    $app->_upgrade();
  }
}
