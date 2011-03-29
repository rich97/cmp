<?php
class PaginationComponent extends Object {

	public $components = array('Session');

	private $cont;

	public function initialize(&$controller) {
		$this->cont =& $controller;
	}

	public function set() {
		$hard = (array) $this->cont->paginate;
		$session = (array) $this->Session->read("pagination.{$this->cont->name}");
		$named = array_merge($this->cont->params['pass'], $this->cont->params['named']);

		$this->Session->delete('pagination');
		if (!empty($named['sort'])) {
			$named['order'] = $named['sort'];
			if (!empty($named['direction'])) {
				$named['direction'] .= " {$named['direction']}";
			}
		}

		$pagination = array_merge($hard, $session, $named);
		$this->Session->write("pagination.{$this->cont->name}", $pagination);
		return $pagination;
	}

}
