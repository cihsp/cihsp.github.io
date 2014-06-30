<?php

if (!isset($_GET['bid'])) {
    header("Location: http://wwwx.cs.unc.edu/Courses/comp426-f13/jamesml/site/index.html");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- NOTE: We use Twitter Bootstrap for layout and responsiveness. We want this application to be largely based in the mobile environment. -->

<head>
    <meta charset="utf-8">
    <title>C I H S P</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/index.css" rel="stylesheet">
    <!-- <script src="js/jquery-1.10.2.min.js"></script> -->
    <script src="/Courses/comp426-f13/jquery-1.10.2.js"></script>
    <script src="js/bathroomview.js"></script>
    <script src="js/Review.js"></script>
    <script src="js/Bathroom.js"></script>
</head>

<body>
    <div class="container-narrow">
        <div class="masthead">
                <ul class="nav nav-pills pull-right">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                </ul>
                <h3 class="muted">Can't I Have Some Privacy?</h3>
        </div>
        <hr>

        <!-- bathroom info -->
        <div id='bathroomHeader' class="row">
        </div>

        <form id="writeReview" style="text-align:right;" action="create.php">
            <input type='hidden' id='bid' name='bid' value=<?php echo $_GET["bid"]; ?>>
            <button type="submit" id="newReview" class="btn btn-large btn-primary">Write a Review</button>
        </form>

        <p></p>

        <div id="review_list">
        </div>
        
        <hr>

        <div class="footer">
            Building, floor, or bathroom missing? Email us at: CIHSP@gmail.com.
            <p>&copy; Allen/Martin 2013</p>
        </div>
    </div>
    <!-- /container -->

</body>

</html>