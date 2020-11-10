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
		$action = $this->getPost( 'action');
		if ( $action == '-system-logon-') {
			if ( $u = $this->getPost( 'u')) {
				if ( $p = $this->getPost( 'p')) {
					$dao = new \dao\users;
					if ( $dto = $dao->validate( $u, $p))
						\Json::ack( $action);
					else
						\Json::nak( $action);
					die;

				}

			}

		}
		throw new dvc\Exceptions\InvalidPostAction;

	}

	protected function authorize() {
		if ( $this->isPost())
			$this->_authorize();
		else
			parent::authorize();

	}

	protected function postHandler() {}

	protected function before() {
		$this->RequireValidation = sys::lockdown();
		parent::before();

	}

	protected function _index( $data = '' ) {
		$this->render([
			'title' => $this->title = sys::name(),
			'primary' => 'readme',
			'secondary' => 'main-index'

		]);

	}

	public function dbinfo() {
		if ( currentUser::isadmin()) {
			$this->render([
				'title' => 'dbinfo',
				'primary' => 'db-info',
				'secondary' => 'main-index']);

		}
		else {
			$this->_index();

		}

	}

	public function logout() {
		session::destroy();
		Response::redirect();

	}

}
