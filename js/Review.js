var Review = function(review_json) {
    this.id = review_json.id;
    this.bid = review_json.bid;
    this.name = review_json.name;
    this.subject = review_json.subject;
    this.reviewText = review_json.reviewText;
    this.overall = review_json.overall;
};

Review.prototype.makeCompactDiv = function() {
    var reviewDiv = $("<div></div>");
    reviewDiv.addClass('review');

    reviewDiv.append('<hr>');

    var starDiv = $("<div></div>");
    for (var i = 0; i < this.overall; i++) {
        starDiv.append("<span class=\"glyphicon glyphicon-star\"></span>");
    }
    for (i = 0; i < 5-this.overall; i++) {
        starDiv.append("<span class=\"glyphicon glyphicon-star-empty\"></span>");
    }
    reviewDiv.append(starDiv);

    var subjectDiv = $("<div></div>");
    subjectDiv.html("<h3><b>"+this.subject+"</h3></b>");
    reviewDiv.append(subjectDiv);

    var nameDiv = $("<div></div>");
    nameDiv.html("<small>Written by "+this.name+"</small>");
    reviewDiv.append(nameDiv);

    var reviewTextDiv = $("<div></div>");
    reviewTextDiv.html(this.reviewText);
    reviewDiv.append(reviewTextDiv);

    // var leftDiv = $("<div></div>");
    // leftDiv.addClass('span6');
    // leftDiv.html(this.subject+"-- <b>" + this.name + "<br><small>"+this.overall+"</small></b>");
    // reviewDiv.append(leftDiv);

    // var rightDiv = $("<div></div>");
    // rightDiv.addClass('span6');
    // rightDiv.html("<b>"+this.reviewText+"</b>");
    // reviewDiv.append(rightDiv);
    
    return reviewDiv;
};
