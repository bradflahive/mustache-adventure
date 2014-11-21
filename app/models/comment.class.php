<?php

/**
 * Comment
 */
class Comment extends CustomModel {

    use Validation;

    protected function validators() {
        return [
            'comment_id' => [FILTER_VALIDATE_INT],
            'user_id' => [FILTER_VALIDATE_INT],
            'message' => [FILTER_CALLBACK, [options => function($value){
                return (is_string($value) && strlen($value) > 0)
                    ? $value : false;
            }]],
            'user_id' => [FILTER_VALIDATE_INT]
        ];
    }

    protected function validateId($id) {
        return $this->validate(['comment_id' => $id]);
    }

	/**
	 * Insert Comment
	 */
	protected function insert($input) {

		// Prepare SQL Values
        $boundedValues = Util::zip(
            ['user_id', 'message'],
            $input
        );

        $validatedValues = $this->validate($boundedValues);

        if (array_key_exists('failed', $validatedValues)) return null;

		// Ensure values are encompassed with quote marks
		$quotedValues = db::auto_quote($validatedValues);

		// Insert
		$results = db::insert('comment', $quotedValues);
		
		// Return the Insert ID
		return $results->insert_id;

	}

	/**
	 * Update Comment
	 */
	public function update($input) {

		// Prepare SQL Values
        $boundedValues = Util::zip(
            ['user_id', 'comment_id',  'message'],
            $input
        );

        $validatedValues = $this->validate($boundedValues);

        if (array_key_exists('failed', $validatedValues)) return null;

		// Ensure values are encompassed with quote marks
		$quotedValues = db::auto_quote($validatedValues);

        db::update(
            'comment',
            $quotedValues,
            "WHERE comment_id = {$this->comment_id}"
        );
		
		// Return a new instance of this user as an object
		return new Comment($this->comment_id);

	}

    // return all comments with respective data 
    public static function getAll() {
        $getPointsFromSql =<<<sql
        SELECT
            comment_id,
            message,
            user_name,
            SUM(points)
        FROM comment
            JOIN user USING (user_id)
            JOIN man_point USING (comment_id)
        GROUP BY comment_id;
sql;
    }

}
