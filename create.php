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
        <title>
            Add A Review
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/index.css" rel="stylesheet">  
        <script src="/Courses/comp426-f13/jquery-1.10.2.js"></script>
        <!--<script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>-->
        <script src="js/create.js" type="text/javascript"></script>
        <script src="js/Bathroom.js" type="text/javascript"></script>
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
            
            <br>
            <br>

            <hr>

            <form action="reviews.php" method="POST" id="new_review_form" name="new_review_form" class="form-horizontal" role="form">
                <input type='hidden' id='bid' name='bid' value=<?php echo $_GET["bid"]; ?>>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input name="name" type="text" class="form-control" id="name" placeholder="Anonymous">
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject" class="col-sm-2 control-label">Subject</label>
                    <div class="col-sm-10">
                        <input name="subject" type="text" class="form-control" id="subject" placeholder="Review Subject">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Overall</label>
                    <div class="col-sm-10">
                        <select name='overall' class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reviewText" class="col-sm-2 control-label">Review</label>
                    <div class="col-sm-10">
                        <textarea name="reviewText" class="form-control" rows="5" id="reviewText" placeholder="Review Text"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit Review</button>
                    </div>
                </div>
            </form>

            <hr>
            <div class="footer">
                Building, floor, or bathroom missing? Email us at: CIHSP@gmail.com.
                <p>
                    &#169; Allen/Martin 2013
                </p>
            </div>
        </div>
    </body>
</html>
