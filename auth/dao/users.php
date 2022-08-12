<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

namespace dvc\auth\dao;

use dvc\{
  dao\_dao,
  db,
  session
};
use strings;

class users extends _dao {
  protected $_db_name = 'users';
  protected $template = __NAMESPACE__ . '\dto\users';

  public function getByEmail($email) {
    if (strings::IsEmailAddress($email)) {

      $sql = sprintf(
        "SELECT * FROM users WHERE `email` = %s",
        $this->quote($email)
      );

      if ($res = $this->Result($sql)) {
        $dto = $res->dto($this->template);
        return $dto;
      }
    }

    return (false);
  }

  public function getByUsername($name) {
    if ($name) {

      $sql = sprintf(
        "SELECT * FROM users WHERE `username` = %s",
        $this->quote($name)
      );

      if ($res = $this->Result($sql)) {
        return $res->dto($this->template);
      }
    }

    return (false);
  }

  public function Insert($a) {
    $a['created'] = $a['updated'] = db::dbTimeStamp();
    return parent::Insert($a);
  }

  public function setLoggedOn($dto): bool {
    session::edit();
    session::set('uid', $dto->id);
    session::close();

    return true;
  }

  public function validate(string $u, string $p): bool {
    $debug = false;
    // $debug = true;
    if ($u && $p) {
      $dto = false;
      if (strings::IsEmailAddress($u)) {
        if ($dto = $this->getByEmail($u)) {
          if (password_verify($p, $dto->password) || $p == $dto->password) {
            if ($debug) \sys::logger(sprintf('<%s> %s', '@ valid', __METHOD__));
            return $this->setLoggedOn($dto);
          } else {
            if ($debug) \sys::logger(sprintf('<@ failed : %s : %s> %s', $dto->id, $p, __METHOD__));
          }
        }
      } elseif ($dto = $this->getByUsername($u)) {
        if (password_verify($p, $dto->password) || $p == $dto->password) {
          if ($debug) \sys::logger(sprintf('<%s> %s', 'valid', __METHOD__));
          return $this->setLoggedOn($dto);
        } else {
          if ($debug) \sys::logger(sprintf('<%s> %s', 'invalid', __METHOD__));
        }
      } else {
        if ($debug) \sys::logger(sprintf('<%s> %s', 'not found', __METHOD__));
      }
    }

    return (false);
  }

  public function UpdateByID($a, $id) {
    $a['updated'] = db::dbTimeStamp();
    return parent::UpdateByID($a, $id);
  }
}
