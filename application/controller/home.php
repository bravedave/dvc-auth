<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class home extends dvc\Controller {
	protected function _authorize() {
		$action = $this->getPost('action');
		if ($action == '-system-logon-') {
			if ($u = $this->getPost('u')) {
				if ($p = $this->getPost('p')) {
					$dao = new \dao\users;
					if ($dto = $dao->validate($u, $p))
						\Json::ack($action);
					else
						\Json::nak($action);
					die;
				}
			}
		}
		throw new dvc\Exceptions\InvalidPostAction;
	}

	protected function authorize() {
		if ($this->isPost())
			$this->_authorize();
		else
			parent::authorize();
	}

	protected function postHandler() {
		$action = $this->getPost('action');

		if ('update-settings' == $action) {
			$a = [
				'name' => $this->getPost('name'),
				'lockdown' => (int)$this->getPost('lockdown')

			];

			$dao = new dao\settings;
			$dao->UpdateByID($a, 1);

			Json::ack($action);
		} else {
			parent::postHandler();
		}
	}

	protected function before() {
		parent::before();
	}

	protected function _index($data = '') {
		$this->render([
			'title' => $this->title = sys::name(),
			'primary' => 'readme',
			'secondary' => 'index'
		]);
	}

	function __construct($rootPath) {
		$this->RequireValidation = sys::lockdown();
		parent::__construct($rootPath);
	}

	public function dbinfo() {
		if (currentUser::isadmin()) {
			$this->render([
				'title' => 'dbinfo',
				'primary' => 'db-info',
				'secondary' => 'main-index'
			]);
		} else {
			$this->_index();
		}
	}

	public function logout() {
		dvc\session::destroy();
		Response::redirect();
	}

	public function settings() {
		$dao = new dao\settings;
		if ($res = $dao->getAll()) {

			$this->data = (object)[
				'settings' => $res->dto(),
				'title' => $this->title = 'Settings'

			];

			$this->load('settings');
		} else {
			throw new Exception('missing system settings');
		}
	}
}
