<?php 


	class GenderValidator extends Validator {
		protected function validateParam($value) {
			return (preg_match('/m|f|M|F/',$value) == 0); /*{
				throw new ValidationException('Invalid indicator for gender: ');
			} else {
				return $value;
			}*/
		}
	}