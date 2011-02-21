<?php
class PaginationComponent extends Object{

	public $components = array('Session');

	public $keys = array(
		'paging' => 'savePaging',
		'search' => 'saveSearch'
	);

	private $__controller;

	private $__paginate;

	public function initialize(&$controller, $settings = array()) {
		$this->__controller =& $controller;
		if ($settings) {
			$this->_set($settings);
		}
	}

	public function saveSearch($search = '') {
		$session = $this->Session->read($this->keys['search'] . '.' . $this->__controller->name);

		if (!$search) {
			$search = $session;
		}

		$this->Session->delete($this->keys['search']);
		$this->Session->write($this->keys['search'] . '.' . $this->__controller->name, $search);
	}

	public function savePaging() {
		$hardCoded = (array) $this->__controller->paginate;
		$session = (array) $this->Session->read(
			$this->keys['paging'] . '.' . $this->__controller->name
		);
		$named = Set::merge(
			$this->__controller->params['pass'],
			$this->__controller->params['named']
		);

		$this->Session->delete($this->keys['paging']);

		if (!empty($named['sort'])) {
			$named['order'] = $named['sort'];

			if (!empty($named['direction'])) {
				$named['order'] .= ' ' . $named['direction'];
			}
		}

		$this->Session->write(
			$this->keys['paging'] . '.' . $this->__controller->name,
			Set::merge(
				$hardCoded, $session, $named
			)
		);
	}

	public function set($model = '') {
		$paging = $this->Session->read($this->keys['paging'] . '.' . $this->__controller->name);
		$search = $this->Session->read($this->keys['search'] . '.' . $this->__controller->name);

		if (!is_array($paging)) {
			$paging = array();
		}

		if (!empty($search) && !is_array($search) && !empty($this->__controller->searchable) && $model) {
			$conditions = array();
			foreach ($this->__controller->searchable as $field) {
				$conditions[] = "lower(" . $model . '.' . $field . ") like '%" . strtolower($search) . "%'";
			}

			$paging['conditions']['or'] = $conditions;
		}

		$this->__controller->paginate = $paging;
	}

}