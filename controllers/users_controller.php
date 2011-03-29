<?php
class UsersController extends CmpAppController {

	public $uses = array('Cmp.User');

    protected $_allow = array('setup');

	public function index() {
		$this->pagination = $this->Pagination->set();
		$this->set('data', $this->paginate('User'));
	}

	public function view($id = null) {
		$this->set('user', $this->User->findById($id));
	}

	public function add() {
		$this->save();
		$this->render('edit');
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
			$flash = 'edit_ok';
			if (empty($this->data['User']['id'])) {
				$flash = 'add_ok';
				$this->User->create();
			}

			if ($this->User->save($this->data)) {
				if (!empty($this->User->password)) {
					$subject = 'You have been registered on CMS.';
					$this->mail($this->User->password, $subject, 'users/send_password', $this->User->data);
				}
				$this->Redirect->flash($this->User->password, array('action' => 'index'));
			}
			$this->Redirect->flash('input_errors');
		}
	}

}
