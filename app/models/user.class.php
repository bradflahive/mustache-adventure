<?php

/**
 * User
 */
class User extends CustomModel {

    use Validation;

    protected function validators() {
        return [
            'user_name' => [FILTER_CALLBACK,
                ['options' => function ($value) {
                    return (strlen($value) > 3) ? $value : false;
            }]],
            'user_id' => [FILTER_VALIDATE_INT],
            'password' => [FILTER_CALLBACK,
                ['options' => function ($value) {
                    return (strlen($value) > 5) ? $value : false;
            }]],
            'points' => [FILTER_VALIDATE_INT,
                ['min_range' => 0, 'max_range' => 5]],
            'email' => [FILTER_VALIDATE_EMAIL]
        ];
    }

    protected function validateId($id) {
        return $this->validate(['user_id' => $id]);
    }

    // determine if the user's password and user name are correct.
    public function isValid($input) {

        // validate user name
        $boundedValues = Util::zip(['user_name', 'password'], $input);
        $validatedValues = $this->validate($boundedValues);
        if (array_key_exists('failed', $validatedValues)) return null;
        $quotedValues = db::auto_quote($validatedValues);
        $sqlPasswordValidation =<<<sql
            SELECT user_id
            FROM user
            WHERE user_name = {$quotedValues['user_name']}
            AND `password` =
            PASSWORD(CONCAT({$quotedValues['user_name']},
                            {$quotedValues['password']}));
sql;

        $result = db::execute($sqlPasswordValidation);
        $user = null;
        while ($row = $result->fetch_assoc()) {
            $user = new User($row['user_id']);
            // throw new Exception($row['user_id']);
            break;
        }
        return $user ? $user : null;
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

        $validatedValues = $this->validate($boundedValues);
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

        $validatedValues = $this->validate($boundedValues);
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
