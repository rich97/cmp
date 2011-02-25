<?php
class UsersController extends CmpAppController {

	public $uses = array('Cmp.User');

    protected $_allow = array('setup');

	public function index() {
		$this->pagination = $this->Pagination->set();
		$this->set('data', $this->User->find('all'));
	}

	public function view($id = null) {
		$this->set('user', $this->User->findById($id));
	}

	public function add() {
		$this->save();
	}

	public function setup() {
		$this->save();
	}

	public function edit($id = null) {
		$this->save();

		if(!$this->data = $this->User->findById($id)) {
			$this->Redirect->flash('no_data', array('action' => 'index'));
		}
	}

	public function account() {
		$this->User->passwordReset();
		$this->save();
	}

    public function delete($id = null) {
		if(!$data = $this->User->findById($id)) {
			if ($this->User->delete($data['User']['id'])) {
				$this->Redirect->flash('delete_ok', array('action' => 'index'));
			}
		}
	}

	private function save() {
		if ($this->data) {
			$flash = 'add_ok';
			$password = $this->User->password();

			if ($this->User->save($this->data)) {
				if (!empty($this->data['User']['id'])) {
					$flash = 'edit_ok';
					$this->mail($this->data['User']['id'], 'Change Me!', 'users/send_password', $this->data);
				}
				$this->Redirect->flash($flash, array('action' => 'index'));
			}
			$this->Redirect->flash('input_errors');
		}
	}

}
