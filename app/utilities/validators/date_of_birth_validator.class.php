<?php 



	class DateOfBirthValidator extends Validator {
		protected function validateParam($value) {
			return(preg_match('/([0-9]{4}-[0-9]{2}-[0-9]{2})/',$value) == 0); /*{
				throw new ValidationException('Invalid Date of Birth: ');
			} else {
				return $value;
			}*/
		}
	}
