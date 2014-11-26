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

    //gets the total points of a user by looking up a user_id
    public function getUserPoints() {

        $userPoints =<<<sql
        SELECT SUM(points) AS total
        FROM man_point
        WHERE user_id = {$this->user_id}
        GROUP BY user_id;
sql;

        $results = db::execute($userPoints);

        $total = null;
        if ($result = $results->fetch_assoc()) {
            $total = $result['total'];
        }
        return $total;
    }

    //gets points of user (via user_id) and uses that criteria to pull in rank
    public function getUserRank() {

        $userPoints =<<<sql
        SELECT SUM(points) AS total
        FROM man_point
        WHERE user_id = {$this->user_id}
        GROUP BY user_id;
sql;

        $results = db::execute($userPoints);

        $total = null;
        if ($result = $results->fetch_assoc()) {
            $total = $result['total'];
        }

        if($total >= 0 && $total < 10){
            $rank = 'Baby Face'; 
        } elseif ($total >= 10 && $total < 20) {
            $rank = 'The Shadow';
        } elseif ($total >= 20 && $total < 30) {
            $rank = 'The Pushbroom';
        } elseif ($total >= 30 && $total < 40) {
            $rank = 'The Burnside';
        } elseif ($total >= 40 && $total < 50) {
            $rank = 'The Western Walrus';
        } elseif ($total >= 50 && $total < 60) {
            $rank = 'The Monopoly Man';
        } elseif ($total >= 60 && $total < 70) {
            $rank = 'The Handlebar';
        } elseif ($total >= 70 && $total < 80) {
            $rank = 'The Fu Manchu';
        } elseif ($total >= 80 && $total < 90) {
            $rank = 'The Super Mario';
        } elseif ($total >= 90 && $total < 100) {
            $rank = 'The Selleck';
        } elseif ($total >= 100) {
            $rank = 'The Chuck Norris';
        } elseif ($total < 0) {
            $rank = 'Woman';
        }

        return $rank;
    }

    //gets the user_name by using the user_id
    public function getUserName() {

        $getUserName =<<<sql
        SELECT user_name
        FROM user
        WHERE user_id = {$this->user_id};
sql;

        $results = db::execute($getUserName);

        $user_name = null;
        if ($result = $results->fetch_assoc()) {
            $user_name = $result['user_name'];
        }
        return $user_name;
    }

    //gets a list of votes the user has made in the past
    public function getVotes() {

        $getVotes =<<<sql
        SELECT * 
        FROM 
        man_point 
        WHERE user_id = {$this->user_id};
sql;

        return db::execute($getVotes);
    }

}
