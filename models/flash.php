<?php
class Flash extends CmpAppModel {

	public $actsAs = array(
		'Cmp.Mapable' => array(
			'fields' =>array(
				'type' => array(
					1 => array('class' => 'fam_accept', 'text' => 'Success'),
					2 => array('class' => 'fam_error', 'text' => 'Notice'),
					3 => array('class' => 'fam_exclamation', 'text' => 'Error'),
				)
			)
		)
	);

}
