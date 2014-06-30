<?php

$conn = new mysqli("classroom.cs.unc.edu", "jjallen", "classroomjja", "jjallendb");

if(mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysql_connect_error();
}

  $build_arr = array("Davis Library", "House Undergraduate Library", "Student Union", "Lenoir", "Sitterson", "Murphey Hall", "Chapman Hall", "Phillips Hall");
  $floor_arr = array("0", "1", "2", "3", "4", "5", "6", "7", "8");
  $roomNumber_arr = array("003", "039", "302", "Front", "Middle", "Back", "8jd", "LOL1", "LOL2");
  $description_arr = array("Middle of the floor", "Back of the house", "One by the stairs on the left", "Upside down", "Handicapped bathroom", "I dunno lol");
  $gender_arr = array("M", "F");

  $_arr = array("Davis Library", "House Undergraduate Library", "Student Union", "Lenoir", "Sitterson", "Murphey Hall", "Chapman Hall", "Phillips Hall");
  $floor_arr = array("0", "1", "2", "3", "4", "5", "6", "7", "8");
  $roomNumber_arr = array("003", "039", "302", "Front", "Middle", "Back", "8jd", "LOL1", "LOL2");
  $description_arr = array("Middle of the floor", "Back of the house", "One by the stairs on the left", "Upside down", "Handicapped bathroom", "I dunno lol");
  $gender_arr = array("M", "F");

for($i=0; $i<50; $i++) {
  // $title = $title_part1[rand(0,5)] . " " .
  //   $title_part2[rand(0,5)] . " " .
  //   $title_part3[rand(0,5)] . " " .
  //   $title_part4[rand(0,5)] . ".";
  // $project = $project_names[rand(0,4)];
  // $complete = 0;
  // if (rand(0,99) < 10) {
  //   $complete = 1
  $building = $build_arr[rand(0,7)];
  $floor = $floor_arr[rand(0,8)];
  $roomNumber = $roomNumber_arr[rand(0,8)];
  $description = $description_arr[rand(0,5)];
  $gender = $gender_arr[rand(0,1)];

  mysqli_query($conn, "INSERT INTO Bathroom (bid, building, floor, roomNumber, description, gender) 
    VALUES (0,'$building','$floor','$roomNumber','$description', '$gender')");
}

  $subject_arr = array("Best Bathroom Ever", "Absolutely Terrible", "Very clean", "Amazing Marble Countertops", "Fantastic views!", "Graffiti EVERYWHERE");
  $name_arr = array("James", "Joe", "Jack", "Bob", "Pat", "Chris", "Adrogenous Name", "Anonymous", "Deadmau5");
  $review = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dictum aliquet leo, ut iaculis ligula fringilla in. Vestibulum vel justo quam. Quisque vitae metus et mi elementum porta. Curabitur pharetra velit metus, in porta felis mollis id. Nunc porttitor luctus neque, blandit ornare orci lobortis sit amet. Suspendisse quis tempor massa. Sed congue bibendum purus, at varius velit sollicitudin in. Phasellus venenatis aliquam nisl, vitae volutpat tellus tincidunt a. Vivamus eu odio mi.";

for($i=0; $i<1000; $i++){

  $rbid = rand(0,50);
  //echo "BID: $rbid <br>";
  $subject = $subject_arr[rand(0,5)];
  //echo "Subject: $subject <br>";
  $name = $name_arr[rand(0,8)];
  //echo "Name: $name <br>";
  $overall = rand(1,5);
  //echo "Overall $overall <br>";

  mysqli_query($conn, "INSERT INTO Review (rid, bid, name, subject, reviewText, overall) 
    VALUES (0,'$rbid','$name','$subject','$review', '$overall')");


  echo "Query Complete <br>";
}


?>
<html>
 <head>
   <title>CBathroom List Setup</title>
 <head>
 <body>
   <h1>Database Setup Complete</h1>
 </body>
</html>