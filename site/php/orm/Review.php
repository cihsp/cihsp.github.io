<?php
ini_set('display_errors', 'On');

class Review
{
	private $rid;
	private $bid;
	private $subject;
	private $reviewText;
	private $overall;

	public static function create($bid, $name, $subject, $reviewText,$overall) {
	    $mysqli = new mysqli("classroom.cs.unc.edu", "jjallen", "classroomjja", "jjallendb");
	    $query = ("insert into Review (bid, name, subject, reviewText, overall) values (" .
	      $bid . ", " .
	      "'" . $mysqli->real_escape_string($name) . "', " .
	      "'" . $mysqli->real_escape_string($subject) . "', " .
	      "'" . $mysqli->real_escape_string($reviewText) . "', ". 
	      $overall . ")");
		$result = $mysqli->query($query);

		if ($result) {
			$new_id = $mysqli->insert_id;
			return new Review($new_id, $bid, $name, $subject, $reviewText, $overall);
		}
		return null;
	}

	public static function findByID($rid) {
		$mysqli = new mysqli("classroom.cs.unc.edu", "jjallen", "classroomjja", "jjallendb");
		$result = $mysqli->query("select * from Review where rid = " . $rid);
		if ($result) {
			if ($result->num_rows == 0){
				return null;
			}
			$review_info = $result->fetch_array();
			return new Review(intval($review_info['rid']),
					       intval($review_info['bid']),
					       intval($review_info['overall']),
					       $review_info['name'],
					       $review_info['subject'],
					       $review_info['reviewText']);
		}
		return null;
	}

	public static function reviewsByBID($bid) {
		$mysqli = new mysqli("classroom.cs.unc.edu", "jjallen", "classroomjja", "jjallendb");
		$result = $mysqli->query("select * from Review where bid = " . $bid);
		if ($result) {
			if ($result->num_rows == 0){
				return null;
			}
			$id_array = array();
			while ($next_row = $result->fetch_array()) {
				$id_array[] = $next_row['rid'];
			}
			return $id_array;
		}
		return null;
	}

	private function __construct($rid, $bid, $name, $subject, $reviewText, $overall) {
		$this->rid = $rid;
		$this->bid = $bid;
		$this->name = $name;
		$this->subject = $subject;
		$this->reviewText = $reviewText;
		$this->overall = $overall;
	}

	public function getID() {
		return $this->rid;
	}
	public function getBid() {
		return $this->bid;
	}
	public function getName() {
		return $this->name;
	}
	public function getSubject() {
		return $this->subject;
	}
	public function getReviewText() {
		return $this->reviewText;
	}
	public function getOverall() {
		return $this->overall;
	}

	// public function setPrice($new_price) {
	// 	// Should do validation here
	// 	// If price is wrong in some way, return false.
		
	// 	$this->price = $new_price;
	// 	// Implicit style updating
	// 	return $this->update();
	// }

	public function getJSON() {
	  $json_rep = array();
	  $json_rep['rid'] = $this->rid;
	  $json_rep['bid'] = $this->bid;
	  $json_rep['name'] = $this->name;
	  $json_rep['subject'] = $this->subject;
	  $json_rep['reviewText'] = $this->reviewText;
	  $json_rep['overall'] = $this->overall;
	  return $json_rep;
	}}