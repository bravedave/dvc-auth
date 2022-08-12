<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class home extends dvc\auth\controller {
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

			Response::redirect(url::$URL, 'updated settings');
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
			'secondary' => 'main-index'
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

			$this->data = $res->dto();

			//~ sys::dump( $this->data);

			$this->render([
				'title' => $this->title = 'Settings',
				'primary' => 'settings',
				'secondary' => 'main-index'

			]);
		} else {
			throw new Exception('missing system settings');
		}
	}
}
