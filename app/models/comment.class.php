<?php

/*
 * Comment
 */
class Comment extends CustomModel {

    use ModelUtils;

    /* 
    * FILTER_VALIDATE_INT and FILTER_CALLBACK are built in validators to PHP
    * FILTER_CALLBACK uses a user defined function (defined below)
    */
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
	public function insert($input) {

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

    /*
    * return all comments 
    */ 
    public static function getAll() {
        $getComments =<<<sql
        SELECT
            comment_id,
            message,
            user_name,
            comment.user_id,
            SUM(points) as total
        FROM comment
            JOIN user USING (user_id)
            JOIN man_point USING (comment_id)
        GROUP BY comment_id
        ORDER BY comment_id DESC;
sql;

        return db::execute($getComments);
    }


    /*
    * gets points 
    */
    public function getPoints() {

        $getPoints =<<<sql
        SELECT SUM(points) AS total
        FROM man_point
        WHERE comment_id = {$this->comment_id}
        GROUP BY comment_id;
sql;

        $results = db::execute($getPoints);

        $total = null;
        if ($result = $results->fetch_assoc()) {
            $total = $result['total'];
        }

        return $total;

    }

    /*
    * when voting, gives points to the user who made the comment.
    */
    public function givePoints($input) {

        // Prepare SQL Values
        $cleanedInput = $this->cleanInput(
            ['user_id', 'points'],
            $input
        );

        if (is_string($cleanedInput)) return null;

        $updatePoints =<<<sql
        REPLACE INTO
            man_point (user_id, comment_id, points)
            VALUES (
                {$cleanedInput['user_id']},
                {$this->comment_id},
                {$cleanedInput['points']});
sql;

        $results = db::execute($updatePoints);

        return $this->getPoints($cleanedInput['comment_id']);

    }


    /*
    * gets past votes made by the user
    */
    public function getVotes($input) {

        $cleanedInput = $this->cleanInput(
            ['user_id'],
            $input
        );

        if (is_string($cleanedInput)) return null;

        $votes =<<<sql
            SELECT *
            FROM 
            man_point
            WHERE user_id = {$cleanedInput['user_id']};
sql;
            $results = db::execute($votes);

            return $this->getVotes($cleanedInput['user_id']);

    }

    /*
    * takes a comment id and removes all data tied to that comment_id
    */
    public function deleteComment() {

        // have to remove from this table first because it uses comment_id as a foreign key
        $remove_from_man_point =<<<sql
                    DELETE
                    FROM 
                    man_point
                    WHERE comment_id = {$this->comment_id};
sql;
        
        $results = db::execute($remove_from_man_point);

        $remove_from_comment =<<<sql
            DELETE 
            FROM 
            comment
            WHERE comment_id = {$this->comment_id}
            LIMIT 1;
sql;
        $results = db::execute($remove_from_comment);

    }

}
