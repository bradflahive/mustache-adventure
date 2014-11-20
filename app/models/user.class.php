<?php

/**
 * User
 */
class User extends CustomModel {

    public static function isValid($input) {
        // do server side validation
        // validate user name
        $sql_values = Util::zip(['user_name', 'password'], $input);
        $sql_values = db::auto_quote($sql_values);
        $sqlPasswordValidation =<<<sql
            SELECT user_id
            FROM user
            WHERE password =
            PASSWORD(CONCAT({$sql_values['user_name']},
                            {$sql_values['password']}));
sql;
        $result = db::execute($sqlPasswordValidation);
        $isValidPassword = (mysql_num_rows($result) == 1);
        return $isValidPassword ? new User($result) : null;
    }

	/**
	 * Insert User
	 */
	protected function insert($input) {

		// Note that Server Side validation is not being done here
		// and should be implemented by you

		// Prepare SQL Values
        $sql_values = Util::zip(
            ['user_name', 'email', 'password'],
            $input
        );

		// Ensure values are encompassed with quote marks
		$sql_values = db::auto_quote($sql_values);

		// Insert
		$results = db::insert('user', $sql_values);
		
		// Return the Insert ID
		return $results->insert_id;

	}

	/**
	 * Update User
	 */
	public function update($input) {

		// Note that Server Side validation is not being done here
		// and should be implemented by you

		// Prepare SQL Values
        $sql_values = Util::zip(
            ['user_id', 'user_name', 'email', 'password'],
            $input
        );

		// Ensure values are encompassed with quote marks
		$sql_values = db::auto_quote($sql_values);

		// Update
		db::update('user', $sql_values, "WHERE user_id = {$this->user_id}");
		
		// Return a new instance of this user as an object
		return new User($this->user_id);

	}

}
