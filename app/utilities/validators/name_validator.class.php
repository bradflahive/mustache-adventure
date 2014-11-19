<?php 




	class NameValidator extends Validator {

		protected function validateParam($value) {
			return (preg_match('/^[A-Za-z]+/',$value) == 0); /*{
				throw new ValidationException('Invalid name: ');
			} else {
				return $value;
			}*/
		}
	}
