<?php
$con= new mysqli("classroom.cs.unc.edu","jjallen","classroomjja","jjallendb");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Clear the Review table.
$sql="DROP TABLE IF EXISTS Review";
if (mysqli_query($con,$sql))
  {
  echo "Dropped table Review";
  }
else
  {
  echo "Error dropping table review: " . mysqli_error($con);
  }

echo "<br>";
 // Delete Existing tables
$sql="DROP TABLE IF EXISTS Bathroom";
// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Dropped table Bathroom";
  }
else
  {
  echo "Error dropping table bathrooms: " . mysqli_error($con);
  }

echo "<br>";


// Create tables
$sql="CREATE TABLE Bathroom(bid INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
	building VARCHAR(25), floor VARCHAR(2), roomNumber VARCHAR(25), description text, gender VARCHAR(25))";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Table Bathrooms created successfully";
  }
else
  {
  echo "Error creating table bathrooms: " . mysqli_error($con);
  }

echo "<br>";

$sql="CREATE TABLE Review(rid INT PRIMARY KEY NOT NULL AUTO_INCREMENT, bid INT,name VARCHAR(50),subject VARCHAR(25), reviewText VARCHAR(255), time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,overall INT,
	 FOREIGN KEY (bid) REFERENCES Bathroom(bid))";

// Execute cubrid_query(query)y
if (mysqli_query($con,$sql))
  {
  echo "Table Review created successfully";
  }
else
  {
  echo "Error creating table Review: " . mysqli_error($con);
  }

echo "<br>";

// Insert bathroom data
$sql="INSERT INTO Bathroom (bid, building, floor, roomNumber, description, gender) VALUES 
(1,'Sitterson','0','SN008','Across From the vending machines','M')";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Bathroom entered successfully";
  }
else
  {
  echo "Error entering bathroom data: " . mysqli_error($con);
  }

echo "<br>";

$sql="INSERT INTO Bathroom (bid, building, floor, roomNumber, description, gender) VALUES 
(2,'Davis Library','1','Back','In the back of the first floor','M')";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Bathroom entered successfully";
  }
else
  {
  echo "Error entering bathroom data: " . mysqli_error($con);
  }
?>

