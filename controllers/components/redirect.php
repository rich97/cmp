<?php
class RedirectComponent extends Object {

/**
 * @var array Requires Cake SessionComponent
 * @access public
 */
	public $components = array(
		'Session'
	);

/**
 * @var string Name of model that contains flash message templates
 * @access public
 */
	public $modelName = 'Cmp.Flash';

/**
 * @var mixed Internal class property to store flash model object once it has been registered
 * @access private
 */
	private $__modelObject = null;

/**
 * @var string Internal property for holding the model plugin name.
 * @access public
 */
	private $__pluginName = '';

/**
 * Passes the controller object by reference for use later. Runs when component
 * is loaded for the first time in the request cycle.
 *
 * @param array $controller Controller object.
 * @param array $settings Settions to load into the component.
 * @access public
 * @return void
 */
	public function initialize(&$controller, $settings = array()) {
		$this->controller =& $controller;
		if ($settings) {
			$this->_set($settings);
		}
	}

/**
 * Loads a message from the a list of unique keys loaded into the configure class and
 * accessd via Configure::read('Flash.key'); can insert variables into loaded template
 * if need be.
 *
 * $message can either be a key string or a full message to display when the page next
 * loads.
 *
 * $message may also be an array. The first key in the array should be a string containing
 * the message template key, the second item is a string or an array of multiple parameters
 * to insert into the string as vsprintf() note that if an incorrect amount of parameters
 * are passed then the values will not be inserted and you will end up with a message similar
 * to "There are %1$d parameter(s)".
 *
 * Examples, calls from the controller based on templates defined flashes table:
 *
 * Input
 * $this->Redirect->flash('This is a flash message');
 *
 * Output
 * Message: This is a flash message
 * Redirect: No
 * Type: flash_note (default)
 *
 * Input
 * $this->Redirect->flash('input_errors');
 *
 * Output
 * Message: Please correct the errors bellow
 * Redirect: No
 * Type: flash_warning
 *
 * Input
 * $this->Redirect->flash(array('add_ok', 'foo-bar'), '/users/dashboard');
 *
 * Output
 * Message: New foo-bar has been saved.
 * Redirect: UsersController::dashboard()
 * Type: flash_success
 *
 * Input (verbose)
 * $this->Redirect->flash(array('delete_ok', array(10)), array('controller' => 'users', 'action' => 'dashboard'), 'success');
 *
 * Output
 * Message: 10 record(s) have been deleted.
 * Redirect: UsersController::dashboard()
 * Type: flash_success
 *
 * If $url is set flash will also redirect to given url after setting the flash message
 * in the session. Anything you can pass to HtmlHelper::link(); you can pass as this parameter.
 *
 * @param mixed $message String or array containing message key or a full message and array/string containing additional variable(s).
 * @param mixed $url Cake formatted url array or string to redirect to before displaying flash.
 * @param string $type Type of flash to display.
 * @return void
 * @access public
 */
	public function flash($message = null, $url = null, $type = 'notice') {
		$message = Set::merge((array) $message, array(null, array()));
		list($message, $params) = $message;
		$params = (array) $params;
		if (is_string($message)) {
			if ($find = $this->__findByKey($message)) {
				extract($find[$this->modelName]);
				$message = $text;
			}

            if (!empty($type['mapped']['text'])) {
                $type = $type['mapped']['text'];
            }

			$this->Session->setFlash(
				$this->__insertVars($message, $params),
				'flash',
				array('class' => strtolower($type))
			);
		}

		if (!$url) {
			return;
		}
		$this->controller->redirect($url);
	}

/**
 * Ensures that the correct amount of parameters are passed to vspintf() to ensure
 * no errors occur when it is run.
 *
 * @param string $string String to insert vars into, uses vspintf().
 * @param array $vars Variables to insert into string.
 * @return string String with variables
 * @access private
 */
	private function __insertVars($string, $vars = array()) {
		$regex = "/%[-+]?(?:[ 0]|['].)?[a]?\d*(?:[.]\d*)?[%bcdeEufFgGosxX]/";
		preg_match_all($regex, $string, $matches);

		if(!empty($matches[0]) && count($matches[0]) === count($vars)) {
			return vsprintf($string, $vars);
		}
		return $string;
	}

/**
 * Load and instantiate a model object (if required) and perform a simple query
 *
 * @param string $key Key to look up in Flash model.
 * @return array A result set pulled from the flash model.
 * @access private
 */
	private function __findByKey($key = '') {
		if (!$this->__modelObject) {
			if (strpos($this->modelName, '.')) {
				$load = $this->modelName;
				list($this->__pluginName, $this->modelName) = explode('.', $load);
			}
			$this->__modelObject = ClassRegistry::init($load);
		}

		$this->__modelObject->recursive = -1;
		$data = $this->__modelObject->findByKey($key);
		return $data;
	}

}