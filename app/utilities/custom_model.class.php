<?php

abstract class CustomModel extends Model {

	public function __construct($id = null) {
        //when value given work on customer otherwise do nothing
        if ($id)  {
            if (is_array($id)) {
                //when id for table is being worked with 
                //call the update method
                if (@$id[$this->get_table_id()] &&
                        method_exists($this, 'update')) {
                    $id = $this->update($id);
                //when no table id is given call the insert method
                } else if (method_exists($this, 'insert')) {
                    $id = $this->insert($id);
                }
            }
            //otherwise get the record with value of $id
            parent::__construct($id);
        }
	}

    // make function `filter_var` return 
    // null instead of false on fail
    private static function addNullFlag($validator) {
        if (@$validator[1]) {
            $validator[1]['flags'] = FILTER_NULL_ON_FAILURE;
            return $validator;
        }
        $validator[] = ['flags' => FILTER_NULL_ON_FAILURE];
    }

    // validate input for all input fields provided, 
    // return only values in class, others will be dropped
    public static function validate($input) {

        // List of validatiors
        $validators = self::validators();
        $validated = [];
        foreach ($input as $key => $value) {

            // skip key if not in list of validators
            if (!@$validators[$key]) continue;

            // if boolean is validated I don't want
            // false return so return null for all failures
            $validateWithNullFlag = 
                self::addNullFlag($validators[$key]);

            // use filter_var function 
            $isValid = 
                call_user_func_array(
                    'filter_var',
                    array_unshift($value, $validators[$key]));

            // return name of failed key if it didn't pass
            // "fail early, fail fast"
            if ($isValid == null) {
                return ['failed' => $key];
            }

            // if successful add to validated array
            $validated[$key] = $isValid;
        }
        return $validated;
    }

}

