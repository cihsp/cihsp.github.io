<?php

ini_set('display_errors', 'On');
require_once('orm/Review.php');
require_once('orm/Bathroom.php');

$path_components = explode('/', $_SERVER['PATH_INFO']);

// Note that since extra path info starts with '/'
// First element of path_components is always defined and always empty.

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  // GET means either instance look up, index generation, or deletion

  // Following matches instance URL in form
  // /review.php/<id>

  if ((count($path_components) >= 2) && ($path_components[1] != "")) {
    // Interpret <id> as integer
    $rid = intval($path_components[1]);

    // Look up object via ORM
    $review = Review::findByID($rid);

    if ($review == null) {
      //  Review not found.
      header("HTTP/1.0 404 Not Found");
      print("Review id: " . $rid . " not found.");
      exit();
    }

    // Check to see if deleting
    if (isset($_REQUEST['delete'])) {
      $review->delete();
      header("Content-type: application/json");
      print(json_encode(true));
      exit();
    } 

    // Normal lookup.
    // Generate JSON encoding as response
    header("Content-type: application/json");
    print($review->getJSON());
    exit();
  }

  // ID not specified, then must be asking for index
  header("Content-type: application/json");
  print(json_encode(Review::getAllIDs()));
  exit();
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Following matches /review.php/<id> form
  if ((count($path_components) >= 2) && ($path_components[1] != "")) {
    // //Interpret <id> as integer and look up via ORM
    // $rid = intval($path_components[1]);
    // $review = Review::findByID($rid);

    // if ($review == null) {
    //     // Review not found.
    //   header("HTTP/1.0 404 Not Found");
    //   print("Review id: " . $rid . " not found while attempting update.");
    //   exit();
    // }

    // // Validate values
    // $new_first = false;
    // if (isset($_REQUEST['name'])) {
    //   $new_first = trim($_REQUEST['name']);
    //   if ($new_first == "") {
    //     header("HTTP/1.0 400 Bad Request");
    //     print("Bad name");
    //     exit();
    //   }
    // }

    // $new_last = false;
    // if (isset($_REQUEST['subject'])) {
    //   $new_last = trim($_REQUEST['subject']);
    //   if ($new_last == "") {
    //     header("HTTP/1.0 400 Bad Request");
    //     print("Bad subject");
    //     exit();
    //   }
    // }

    // // Update via ORM
    // if ($new_first != false) {
    //   $review->setFirst($new_first);
    // }

    // if ($new_last != false) {
    //   $review->setLast($new_last);
    // }

    // // Return JSON encoding of updated Review
    // header("Content-type: application/json");
    // print($review->getJSON());
    // exit();

    // Return JSON encoding of updated Review
    header("HTTP/1.0 400 Bad Request");
    print("Post Reviews:<id> not set for anything yet");
    exit();
  } else { // Creating a new Review item

    // Validate values
    if (!isset($_REQUEST['bid'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing bid");
      exit();
    }
    $bid = $_REQUEST['bid'];

    // Validate values
    if (!isset($_REQUEST['name'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing name");
      exit();
    }

    $name = trim($_REQUEST['name']);
    if ($name == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad name");
      exit();
    }

    if (!isset($_REQUEST['subject'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing subject name");
      exit();
    }

    $subject = trim($_REQUEST['subject']);
    if ($subject == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad subject");
      exit();
    }

    if (!isset($_REQUEST['reviewText'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing review text");
      exit();
    }

    $reviewText = trim($_REQUEST['reviewText']);
    if ($reviewText == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad review text");
      exit();
    }

    // Validate values
    if (!isset($_REQUEST['overall'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing Overall score");
      exit();
    }
    $overall = $_REQUEST['overall'];



    // Create new Review via ORM
    $new_review = Review::create($bid, $name, $subject,$reviewText,$overall);

    // Report if failed
    if ($new_review == null) {
      header("HTTP/1.0 500 Server Error");
      print("Server couldn't create new review.");
      exit();
    }

    //Generate JSON encoding of new Review
    header("Content-type: application/json");
    print($new_review->getJSON());
    exit();
  }
}

// If here, none of the above applied and URL could
// not be interpreted with respect to RESTful conventions.

header("HTTP/1.0 400 Bad Request");
print("Did not understand URL");

?>