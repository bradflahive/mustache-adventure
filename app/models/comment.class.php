<?php

/**
 * Comment
 */
class Comment extends CustomModel {

    use ModelUtils;


    // FILTER_VALIDATE_INT and FILTER_CALLBACK are built in validators to PHP
    // FILTER_CALLBACK uses a user defined function (defined below)
    protected function validators() {
        return [
            'comment_id' => [FILTER_VALIDATE_INT],
            'user_id' => [FILTER_VALIDATE_INT],
            'message' => [FILTER_CALLBACK, [options => function($value){
                return (is_string($value) && strlen($value) > 0)
                    ? $value : false;
            }]],
            'points' => [FILTER_VALIDATE_INT,
                ['min_range' => 0, 'max_range' => 5]]
        ];
    }

    protected function validateId($id) {
        return $this->validate(['comment_id' => $id]);
    }

	/**
	 * Insert Comment
	 */
    //renamed from insert to newCommentTODO -Nate also made public
	public function newComment($input) {

		// Prepare SQL Values
        $cleanedInput = $this->cleanInput(
            ['user_id', 'message'],
            $input
        );

        if (is_string($cleanedInput)) return null;

		// Insert
		$results = db::insert('comment', $cleanedInput);
		
		// Return the Insert ID
		return $results->insert_id;

	}



	/**
	 * Update Comment
	 */
	public function update($input) {

		// Prepare SQL Values
        $cleanedInput = $this->cleanInput(
            ['user_id', 'comment_id',  'message'],
            $input
        );

        if (is_string($cleanedInput)) return null;

        db::update(
            'comment',
            $cleanedInput,
            "WHERE comment_id = {$this->comment_id}"
        );
		
		// Return a new instance of this user as an object
		return new Comment($this->comment_id);

	}

    // return all comments 
    public static function getAll() {
        $getPointsFromSql =<<<sql
        SELECT
            comment_id,
            message,
            user_name,
            SUM(points) as total
        FROM comment
            JOIN user USING (user_id)
            JOIN man_point USING (comment_id)
        GROUP BY comment_id
        ORDER BY comment_id DESC;
sql;

        //returns the comments
        return db::execute($getPointsFromSql);
    }

    //TODO Jon-wrote this trying to match your style.  Feel free to change/correct as needed. -Nate
    //currently public, should probably make protected
    //after cleaned input implemented, no longer inserts into DB TODO
    public function givePoints($input) {

        print_r($input);

        // Prepare SQL Values
        $cleanedInput = $this->cleanInput(
            ['user_id', 'comment_id', 'points'],
            $input
        );

        if (is_string($cleanedInput)) return null;

        // Insert
        // $results = db::insert_duplicate_key_update('man_point', $cleanedInput);
        $updatePoints =<<<sql
        REPLACE INTO
            man_point (user_id, comment_id, points)
            VALUES (
                {$cleanedInput['user_id']},
                {$cleanedInput['comment_id']},
                {$cleanedInput['points']});
sql;

        print_r($cleanedInput);
        $results = db::execute($updatePoints);

        // Return the Insert ID
        return $results->insert_id;
    }

}
