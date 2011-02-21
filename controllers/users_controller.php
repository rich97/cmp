<?php
class UsersController extends CmpAppController {

	public $uses = array('Cmp.User');

	public $searchable = array('username', 'email');

    protected $_allow = array('setup');

	public function index() {
		$search = '';
		if (!empty($this->data['User']['search'])) {
			$search = $this->data['User']['search'];
		}

		$this->Pagination->saveSearch($search);
		$this->Pagination->savePaging();
		$this->Pagination->set('User');

		$this->set('model', 'User');
		$this->set('data', $this->paginate('User'));
		$this->set('searched', $this->Session->read('saveSearch.' . $this->name));
		$this->set('totalRecords', $this->User->find('count', array('recursive' => -1)));
	}

	public function view($id = null) {
        if (!$id || !$user = $this->User->findById($id)) {
			$this->Redirect->flash('no_data', array(
				'controller' => 'users', 'action' => 'setup'
			));
        }

		$this->set(compact('user'));
	}

	public function add() {
		if (Authsome::get('User.id') != 1) {
			$this->Redirect->flash('no_access',
				array('controller' => 'users', 'action' => 'index')
			);
		}

		if ($this->data) {
			$this->data['User']['password'] = $password = $this->_randomString();
			if ($this->User->save($this->data)) {
				$this->__sendPassword(
					$this->data['User']['username'],
					$this->data['User']['email'],
					$password
				);

				$this->Redirect->flash('add_ok', array(
					'controller' => 'users', 'action' => 'index'
				));
			}
			$this->Redirect->flash('input_errors');
		}
	}

	public function edit() {
		if (Authsome::get('User.id') != 1) {
			$this->Redirect->flash('no_access', array(
				'controller' => 'users', 'action' => 'index'
			));
		}

		if ($this->data) {
			if ($this->User->save($this->data)) {
				$this->Redirect->flash('edit_ok', array(
					'controller' => 'users', 'action' => 'setup'
				));
			}
			$this->Redirect->flash('input_errors');
		}

		$this->data = $this->User->findById($id);
	}

	public function setup() {
		if ($this->User->find('count')) {
			$this->redirect(array('controller' => 'dashboards', 'action' => 'index'));
		}

		if ($this->data) {
			$this->data['User']['password'] = $password = $this->_randomString();
			if ($this->User->save($this->data)) {
				$this->__sendPassword(
					$this->data['User']['username'],
					$this->data['User']['email'],
					$password
				);

				$this->Redirect->flash('root_setup', array(
					'controller' => 'users', 'action' => 'setup'
				));
			}
			$this->Redirect->flash('input_errors');
		}
	}

	public function account() {
		if ($this->data) {
			if ($this->data['User']['new_password']) {
				$this->User->passwordReset();
				$this->data['User']['password'] = $this->data['User']['new_password'];
			}

			if ($this->User->save($this->data)) {
				$this->Redirect->flash('account_saved', array('action' => 'index'));
			}
			$this->Redirect->flash('input_errors');
		}

		$id = Authsome::get('User.id');
		$this->data = $this->User->findById($id);
	}

    public function delete($id = null) {
		if (!$id) {
			if (!$this->data) {
            	$this->Redirect->flash('no_data', array(
            	    'controller' => 'users', 'action' => 'index'
            	));
			}
			$id = array_keys($this->data['User']['id']);
		}

		$ids = (array) $id;
		foreach ($ids as $id) {
			$this->User->delete($id);
		}
		$this->Redirect->flash('delete_ok', array(
			'controller' => 'users', 'action' => 'index'
		));
    }

    public function clear_search($action = 'index') {
		$this->Session->delete('saveSearch');
		$this->redirect(compact('action'));
    }

    private function __sendPassword($username, $email, $password) {
		$data = array(
			'username' => $username,
			'password' => $password,
			'host' => $_SERVER['HTTP_HOST'],
			'admin_url' => 'admin',
			'project' => 'Aomori CMS',
			'site' => 'Aomori'
		);

		$subject = __('You have been registered on the Aomori CMS.', true);
		$this->_sendmail($email, $subject, 'users/send_password', $data);
    }

}
