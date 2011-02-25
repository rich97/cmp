<?php
class LoginsController extends CmpAppController {

	public $uses = array(
		'Cmp.User'
	);

    protected $_allow = array('index', 'logout');

	public function index() {
		if (!$this->User->find('count')) {
			$this->Redirect->flash('setup_root', array(
				'controller' => 'users',
				'action' => 'setup'
			);
		}

		if ($this->data) {
			if (Authsome::login($this->data['User'])) {
				$this->Redirect->flash('logged_in', array('controller' => 'dashboards', 'action' => 'index'));
			} else {
				$this->Redirect->flash('bad_user_pass');
			}
		}
	}

	public function logout() {
		Authsome::logout();
		$this->Redirect->flash('logged_out', array('controller' => 'dashboards', 'action' => 'index'));
	}

}
