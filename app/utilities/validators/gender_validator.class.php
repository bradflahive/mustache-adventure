<?php 


	class GenderValidator extends Validator {
		protected function validateParam($value) {
			if (preg_match('/m|f|M|F/',$value) == 0) {
				return 'Invalid indicator for gender. M/F';
			} else {
				return $value;
			}
		}
	}