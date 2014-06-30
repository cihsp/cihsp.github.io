<?php

//ini_set('display_errors', 'On');
require_once('orm/Bathroom.php');
require_once('orm/Review.php');

$path_components = explode('/', $_SERVER['PATH_INFO']);

// Note that since extra path info starts with '/'
// First element of path_components is always defined and always empty.
// Note that we only retreive bathrooms, never update or add new ones.

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ((count($path_components) >= 2) &&
      ($path_components[1] != "")) {
    // Interpret <id> as integer
    $bath_id = intval($path_components[1]);

    // Look up object via ORM
    $bathroom = Bathroom::findByID($bath_id);

    if ($bathroom == null) {
      // Bathroom not found.
      header("HTTP/1.0 404 Not Found");
      print("Bathroom id: " . $bath_id . " not found.");
      exit();
    }
    
    // /bathrooms.php/<bid>/reviews
    if (count($path_components)==4) {
      header("Content-type: application/json");
      print(json_encode(Review::reviewsByBID($bath_id)));
      exit();
    }

    // Normal lookup.
    // Generate JSON encoding as response
    header("Content-type: application/json");
    print($bathroom->getJSON());
    exit();

  }
    
  //ID Not specified, want all IDs
  header("Content-type: application/json");
  print(json_encode(Bathroom::getAllIDs()));
  exit();
}

// If here, none of the above applied and URL could
// not be interpreted with respect to RESTful conventions.
// Request other than GET

header("HTTP/1.0 400 Bad Request");
print("Did not understand URL");
exit();

?>