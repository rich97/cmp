<?php
class User extends CmpAppModel {

    public $validate = array(
		'username' => array(
			'format' => array(
				'rule' => array(
					'custom', '/^[A-z0-9_-]{1,}$/'
				),
				'message' => 'Bad username. Use only letters, numbers, hyphen (-) and the underscore (_).'
			),
			'length' => array(
				'rule' => array(
					'minLength', '4'
				),
				'message' => 'Enter a minimum of 4 characters.'
			),
			'unique' => array(
				'rule' => array(
					'isUnique'
				),
				'message' => 'This username is already registered.'
			)
		),
		'email' => array(
			'email' => array(
				'rule' => array(
					'email'
				),
				'message' => 'Enter a valid email address.'
			)
		)
    );
    
    public $validatePasswordReset = array(
		'current_password' => array(
			'rule' => array(
				'isCorrectPassword'
			),
			'message' => 'Bad password, if you have lost your password then you can contact an administrator to reset it.'
		),
		'new_password' => array(
			'rule' => array(
				'minLength', '6'
			),
			'message' => 'Password should be at least 6 characters long.'
		),
		'confirm_new_password' => array(
			'rule' => array(
				'confirmPasswordMatch'
			),
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
		$password = $this->data['User']['password'];
		if (!empty($password)) {
			$this->data['User']['password'] = Authsome::hash($password);
		}
		return true;
	}

    public function passwordReset() {
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

    public function confirmPasswordMatch () {
		$user = $this->data['User'];
		if($user['new_password'] === $user['confirm_new_password']) {
			return true;
		}
		return false;
    }

}
