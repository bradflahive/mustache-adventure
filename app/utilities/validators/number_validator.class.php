<?php 



class NumberValidator extends Validator {

	protected function validateParam($value) {
		return (!is_numeric($value)) {
			return 'Invalid number: ';
		} else {
			return $value;
		}
	}
}
