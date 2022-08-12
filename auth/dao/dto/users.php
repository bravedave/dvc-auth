<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

namespace dvc\auth\dao\dto;

use dvc\dao\dto\_dto;

class users extends _dto {
  public $id = 0;

  public $username = '';
  public $name = '';
  public $email = '';
  public $pass = '';
  public $admin = '';
  public $created = '';
  public $updated = '';
}
