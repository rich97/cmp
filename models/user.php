<?php
class User extends CmpAppModel {

	public $password = '';

    public $validate = array(
		'username' => array(
			'format' => array(
				'rule' => array('custom', '/^[A-z0-9_-]{1,}$/'),
				'message' => 'Use only letters, numbers, hyphen and the underscore.'
			),
			'length' => array(
				'rule' => array('minLength', '4'),
				'message' => 'Enter a minimum of 4 characters.'
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'This username is already in use.'
			)
		),
		'email' => array(
			'format' => array(
				'rule' => array('email'),
				'message' => 'Enter a valid email address.'
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'This username is already in use.'
			)
		)
    );
    
    public $validatePasswordReset = array(
		'current_password' => array(
			'rule' => array('isCorrectPassword'),
			'message' => 'Incorrect Password'
		),
		'new_password' => array(
			'rule' => array('minLength', '6'),
			'message' => 'Password should be at least 6 characters long.'
		),
		'confirm_new_password' => array(
			'rule' => array('confirmPasswordMatch'),
			'message' => '"New password" and "Confirm new password" do not match.'
		)
    );

    public function authsomeLogin($type, $conditions = array()) {
        switch ($type) {
            case 'guest':
                return array();
            case 'credentials':
                $password = Authsome::hash($conditions['password']);
                $conditions = array(
                    'User.username' => $conditions['username'],
                    'User.password' => $password,
                );
                break;
            default:
                return null;
        }
        return $this->find('first', compact('conditions'));
    }

	public function beforeSave() {
		$this->password();
		return true;
	}

    protected function password($length = 8) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		for ($p = 0; $p < $length; $p++) {
				$this->password .= $characters[mt_rand(0, strlen($characters) - 1)];
		}

		$this->data['User']['password'] = Authsome::hash($this->password);
    }

    public function passwordChange() {
		$this->validate = array_merge(
			$this->validate,
			$this->validatePasswordReset
		);
    }

    public function isCorrectPassword() {
		$user = $this->data['User'];
		return $this->find('first', array(
			'conditions' => array(
				'User.id' => $user['id'],
				'User.password' => Authsome::hash($user['current_password'])
			)
		));
    }

    public function confirmPasswordMatch() {
		$user = $this->data['User'];
		if($user['new_password'] === $user['confirm_new_password']) {
			return true;
		}
		return false;
    }

}
