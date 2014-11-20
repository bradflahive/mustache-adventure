<?php

/**
 * User
 */
class User extends CustomModel {

    protected static function validators() {
        return [
            'user_name' => [FILTER_CALLBACK,
                ['options' => function ($value) {
                    return (is_string($value) && strlen($value) > 3)
                        ? $value : false;
            }]],
            'user_id' => [FILTER_VALIDATE_INT],
            'password' => [FILTER_CALLBACK,
                ['options' => function ($value) {
                    return (is_string($value) && strlen($value) > 6);
            }]]
        ];
    }

    // determine if the user's password and user name are correct.
    public static function isValid($input) {

        // validate user name
        $boundedValues = Util::zip(['user_name', 'password'], $input);
        $validatedValues = self::validate($boundedValues);
        if (array_key_exists('failed', $validatedValues)) return null;
        $quotedValues = db::auto_quote($validatedValues);
        $sqlPasswordValidation =<<<sql
            SELECT user_id
            FROM user
            WHERE password =
            PASSWORD(CONCAT({$quotedValues['user_name']},
                            {$quotedValues['password']}));
sql;
        $result = db::execute($sqlPasswordValidation);
        $isValidPassword = (mysql_num_rows($result) == 1);
        return $isValidPassword ? new User($result) : null;
    }

	/**
	 * Insert User
	 */
	protected function insert($input) {

		// Prepare SQL Values
        $boundedValues = Util::zip(
            ['user_name', 'email', 'password'],
            $input
        );

        $validatedValues = self::validate($boundedValues);
        if (array_key_exists('failed', $validatedValues)) return null;

		// Ensure values are encompassed with quote marks
		$quotedValues = db::auto_quote($validatedValues);

		// Insert
		$results = db::insert('user', $quotedValues);
		
		// Return the Insert ID
		return $results->insert_id;

	}

	/**
	 * Update User
	 */
	public function update($input) {

		// Prepare SQL Values
        $boundedValues = Util::zip(
            ['user_id', 'user_name', 'email', 'password'],
            $input
        );

        $validatedValues = self::validate($boundedValues);
        if (array_key_exists('failed', $validatedValues)) return null;

		// Ensure values are encompassed with quote marks
		$quotedValues = db::auto_quote($validatedValues);

		// Update
        db::update(
            'user',
            $quotedValues,
            "WHERE user_id = {$this->user_id}"
        );
		
		// Return a new instance of this user as an object
		return new User($this->user_id);

	}

}
