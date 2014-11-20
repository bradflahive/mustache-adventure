<?php 



	class DateOfBirthValidator extends Validator {
		protected function validateParam($value) {
			if (preg_match('/([0-9]{4}-[0-9]{2}-[0-9]{2})/',$value) == 0) {
				return 'Invalid Date of Birth. YYYY-MM-DD';
			} else {
				return $value;
			}
		}
	}
