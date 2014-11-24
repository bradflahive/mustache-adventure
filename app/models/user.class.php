<?php

/**
 * User
 */
class User extends CustomModel {

    use ModelUtils;

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
        $cleanedInput = $this->cleanInput(['user_name', 'password'], $input);
        if (is_string($cleanedInput)) return null;

        $sqlPasswordValidation =<<<sql
            SELECT user_id
            FROM user
            WHERE user_name = {$cleanedInput['user_name']}
            AND `password` =
            PASSWORD(CONCAT({$cleanedInput['user_name']},
                            {$cleanedInput['password']}));
sql;

        $result = db::execute($sqlPasswordValidation);
        $user = null;
        if ($row = $result->fetch_assoc()) {
            $user = new User($row['user_id']);
        }
        return $user;
    }

	/**
	 * Insert User
	 */
	protected function insert($input) {

		// Prepare SQL Values
        $cleanedInput = $this->cleanInput(
            ['user_name', 'email', 'password'],
            $input, ['password']
        );

        if (is_string($cleanedInput)) {
            return null;
        }

        $passwordInsert =<<<sql
        INSERT INTO 
        user (user_name, email, `password`)
        VALUES ({$cleanedInput['user_name']}, {$cleanedInput['email']},
        PASSWORD(CONCAT({$cleanedInput['user_name']}, {$cleanedInput['password']})));
sql;

		// Insert
		$results = db::execute($passwordInsert);

		// Return the Insert ID
		return $results->insert_id;

	}

	/**
	 * Update User
	 */
	public function update($input) {

		// Prepare SQL Values
        $cleanedInput = $this->cleanInput(
            ['user_id', 'user_name', 'email', 'password'],
            $input
        );

        if (is_string($cleanedInput)) return null;

		// Update
        db::update(
            'user',
            $cleanedInput,
            "WHERE user_id = {$this->user_id}"
        );
		
		// Return a new instance of this user as an object
		return new User($this->user_id);

	}

}
