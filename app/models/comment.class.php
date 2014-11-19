<?php

/**
 * Comment
 */
class Comment extends CustomModel {

	/**
	 * Insert Comment
	 */
	protected function insert($input) {

		// Note that Server Side validation is not being done here
		// and should be implemented by you

		// Prepare SQL Values
        $sql_values = Util::zip(
            ['user_id', 'message'],
            $input
        );

		// Ensure values are encompassed with quote marks
		$sql_values = db::auto_quote($sql_values);

		// Insert
		$results = db::insert('comment', $sql_values);
		
		// Return the Insert ID
		return $results->insert_id;

	}

	/**
	 * Update Comment
	 */
	public function update($input) {

		// Note that Server Side validation is not being done here
		// and should be implemented by you

		// Prepare SQL Values
        $sql_values = Util::zip(
            ['user_id', 'comment_id',  'message'],
            $input
        );

		// Ensure values are encompassed with quote marks
		$sql_values = db::auto_quote($sql_values);

        db::update(
            'comment',
            $sql_values,
            "WHERE comment_id = {$this->comment_id}"
        );
		
		// Return a new instance of this user as an object
		return new Comment($this->comment_id);

	}

    public function getCommentBox() {
        $getPointsFromSql =<<<sql
        SELECT
            points
            comment_id
            
sql;
    }

}
