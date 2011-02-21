<?php
class UsersController extends CmpAppController {

	public $uses = array('Cmp.User');

    protected $_allow = array('setup');

	public function index() {}

	public function view($id = null) {}

	public function add() {}

	public function edit() {}

	public function setup() {}

	public function account() {}

    public function delete($id = null) {}

}
