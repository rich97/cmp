<?php
class UsersController extends CmpAppController {

	public $uses = array('Cmp.User');

    protected $_allow = array('setup');

	public function index() {
		$this->pagination = $this->Pagination->set();
		$this->set('data', $this->User->find('all'));
	}

	public function view($id = null) {
		$this->User->findById($id);
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
			// No data
		}
	}

	public function account() {
		$this->User->passwordReset();
		$this->save();
	}

    public function delete($id = null) {
		if(!$data = $this->User->findById($id)) {
			if ($this->User->delete($data['User']['id'])) {
				// Done!
			}
		}
	}

	private function save() {
		if ($this->data) {
			if (!empty($this->data['User']['id'])) {
				$this->User->create();
			}

			if ($this->User->save($this->data)) {
				// Done!
			}
			// Errors ...
		}
	}

}
