<?php
	class Donor extends AppModel {
		var $name = 'Donor';
		var $primaryKey = 'd_id';
		var $validate = array(
			'd_name' => array(
				'rule' => 'notEmpty',
				'message' => 'Please specify donor\'s name'
			)/*,
			'd_email' => array(
				'rule' => 'email',
				'message' => 'Please specify a valid email'
			)*/
		);
	}
?>