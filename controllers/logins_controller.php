<?php
class LoginsController extends CmpAppController {

	public $uses = array(
		'Cmp.User'
	);

    protected $_allow = array('index', 'logout');

	public function index() {
		if (!$this->User->find('count')) {
			// Redirect to setup
		}

		if ($this->data) {
			if (Authsome::login($this->data['User'])) {
				// Redirect to dashboard or last accessed page
			} else {
				// Try to enter your password again
				$this->Redirect->flash('bad_user_pass');
			}
		}
	}

	public function logout() {
		Authsome::logout();
		$this->Redirect->flash('logged_out', array(
			'controller' => 'dashboards',
			'action' => 'index'
		));
	}

}
