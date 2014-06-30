<?php

class Bathroom
{
	private $bid;
	private $building;
	private $floor;
	private $roomNumber;
	private $description;
	private $gender;
	
	public static function create($building, $floor, $roomNumber, $description, $gender){
	    $mysqli = new mysqli("classroom.cs.unc.edu", "jjallen", "classroomjja", "jjallendb");
		$result = $mysqli->query("insert into Bathroom (bid,building,floor,roomNumber,description,gender)
											values (0, . $building . ', ' . $floor . ',' . $roomNumber . ', ' . $description . ', ' .$gender . ')'");

		if($result) {
			$new_id = $mysqli->insert_id;
			return new Bathroom($new_id, $building, $floor, $roomNumber, $description, $gender);
		}
		return null;
	}

	public static function findByID($bid) {
	    $mysqli = new mysqli("classroom.cs.unc.edu", "jjallen", "classroomjja", "jjallendb");
		$result = $mysqli->query("SELECT * FROM Bathroom WHERE bid = " . $bid);
		if ($result) {
			if ($result->num_rows == 0){
				return null;
			}
			$review_info = $result->fetch_array();
			return new Bathroom(intval($review_info['bid']),
					       $review_info['building'],
					       $review_info['floor'],
					       $review_info['roomNumber'],
					       $review_info['description'],
					       $review_info['gender']);		
		}
		return null;
	}

	public static function getAllIDs(){
		$mysqli = new mysqli("classroom.cs.unc.edu", "jjallen", "classroomjja", "jjallendb");

		$result = $mysqli->query("SELECT bid FROM Bathroom");
		$id_array = array();

		if($result){
			while($next_row = $result->fetch_array()) {
				$id_array[] = intval($next_row['bid']);
			}
		}
		return $id_array;
	}

	private function __construct($bid, $building, $floor, $roomNumber, $description, $gender){
		$this->bid = $bid;
		$this->building = $building;
		$this->floor = $floor;
		$this->roomNumber = $roomNumber;
		$this->description = $description;
		$this->gender = $gender;
	}

	public function getBathroomID() {
		return $this->bid;
	}

	public function getBuilding() {
		return $this->building;
	}

	public function getFloor() {
		return $this->floor;
	}

	public function getRoomNumber() { 
		return $this->roomNumber;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getGender() {
		return $this->gender;
	}

	public function getJSON() {
		$json_rep = array();
		$json_rep['bid'] = $this->bid;
		$json_rep['building'] = $this->building;
		$json_rep['floor'] = $this->floor;
		$json_rep['roomNumber'] = $this->roomNumber;
		$json_rep['description'] = $this->description;
		$json_rep['gender'] = $this->gender;
		return json_encode($json_rep);
	}
}