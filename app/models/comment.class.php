<?php

/**
 * Comment
 */
class Comment extends CustomModel {

    use Validation;


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
            'user_id' => [FILTER_VALIDATE_INT]
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

        // What is "$this" and the validate method?
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
    public function givePoints($input) {

        // Prepare SQL Values
        $boundedValues = Util::zip(
            ['user_id', 'comment_id', 'points'],
            $input
        );

        // What is "$this" and the validate method? TODO
        // $validatedValues = $this->validate($boundedValues);
        $validatedValues = $boundedValues;

        if (array_key_exists('failed', $validatedValues)) return null;

        // Ensure values are encompassed with quote marks
        $quotedValues = db::auto_quote($validatedValues);

        // Insert
        $results = db::insert('man_point', $quotedValues);

        // Return the Insert ID
        return $results->insert_id;
    }





     

}
