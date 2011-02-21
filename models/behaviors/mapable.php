<?php
class MapableBehavior extends ModelBehavior {

	public $settings = array();

	public $defaults = array(
		'defaultMap' => array(),
		'fields' => array()
	);

	public function setup(&$model, $config = array()) {
		$config = (array) $config;
		$this->settings[$model->alias] = array_merge($this->defaults, $config);
	}

	public function	afterFind(&$model, $results) {
		$type = $model->findQueryType;
		if ($type == 'first' || $type == 'all') {
			foreach ($results as $key => $result) {
                if ($this->settings[$model->alias]['fields']) {
                    foreach ($this->settings[$model->alias]['fields'] as $field => $options) {
                        if (is_integer($field)) {
                            $field = $options;
                            $options = $this->settings[$model->alias]['defaultMap'];
                        }
        
                        if ($options && !empty($result[$model->alias][$field])) {
                            $value = $result[$model->alias][$field];
                            $result[$model->alias][$field] = array(
                                $field => $value,
                                'mapped' => $options[$value]
                            );
                        }
                    }
                }
                $results[$key] = $result;
			}
		}

		return $results;
	}

}
