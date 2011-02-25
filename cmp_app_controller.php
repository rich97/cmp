<?php
class CmpAppController extends AppController {

	public $components = array(
		'Email', 'Session', 'Cmp.Redirect', 'Cmp.Pagination',
		'Authsome.Authsome' => array(
			'model' => 'Cmp.User'
		)
	);

	public $helpers = array(
		'Time', 'Paginator',
		'Cmp.Gravatar'
	);

	public $title;

	protected $_allow = array();

	public function beforeFilter() {
		$currentRoute = array(
			'plugin' => $this->params['plugin'],
			'controller' => $this->params['controller'],
			'action' => $this->params['action']
		);

		if (!in_array($currentRoute['action'], $this->_allow)) {
			if (!$user = $this->Authsome->get()) {
				$this->Redirect->flash('log_in', array(
					'controller' => 'logins',
					'action' => 'index'
				));
			}
		}

		$this->set('breadcrumbs', $this->crumbs());
	}

    protected function mail($to, $subject, $template, $vars = array(), $send_as = 'both') {
		$this->Email->to = $to;
		$this->Email->subject = $subject;
		$this->Email->replyTo = 'aomori@aca.or.jp';
		$this->Email->from = 'Aomori <noreplay@aca.or.jp>';
		$this->Email->template = $template;
		$this->Email->sendAs = $send_as;

		foreach ($vars as $name => $value) {
			$this->set($name, $value);
		}

		return $this->Email->send();
    }

    protected function random($length = 8) {
		$string = '';
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
		return $string;
    }

	private function crumbs() {
		if ($this->action !== 'index') {
			$crumbs = array(
				$this->title => array(
					'controller' => strtolower($this->name),
					'action' => 'index'
				),
				Inflector::humanize($this->action)
			);
		} else {
			$crumbs = array($this->title);
		}

		return $crumbs;
	}

}
