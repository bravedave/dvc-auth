<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class settings extends Controller {
	protected function postHandler() {
		$action = $this->getPost('action');

		if ( 'update' == $action) {
			$a = [
				'name' => $this->getPost( 'name'),
				'lockdown' => (int)$this->getPost('lockdown')

			];

			$dao = new dao\settings;
			$dao->UpdateByID( $a, 1);

			Response::redirect( url::$URL, 'updated settings');

		}
		else {
			throw new dvc\Exceptions\InvalidPostAction;

		}

	}

	protected function _index() {
		$dao = new dao\settings;
		if ( $res = $dao->getAll()) {

			$this->data = $res->dto();

			//~ sys::dump( $this->data);

			$this->render([
				'title' => $this->title = 'Settings',
				'primary' => 'settings',
				'secondary' => 'main-index'

			]);

		}
		else {
			throw new \Exception( 'missing system settings');

		}

	}

	protected function before() {
		$this->RequireValidation = sys::lockdown();
		parent::before();

	}

}