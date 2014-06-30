var base_url = "http://wwwx.cs.unc.edu/Courses/comp426-f13/jamesml/site";

var bathrooms = new Array();
var selectedBID = -1;

$(document).ready(function() {
    $(".err").hide();
    $("#submit").hide();
	$("#building").val("None Selected");
	$("#floor").val("None Selected");
	$("#gender").val("None Selected");

    $.ajax(base_url + "/php/bathrooms.php/", {
        type: "GET",
        dataType: "json",
        success: function(bath_ids, status, jqXHR) {
            //console.log(bath_ids.length)
            for (var i = 0; i < bath_ids.length; i++) {
                addBathroom(bath_ids[i]);
            }
        }
    });
});

$(document).on("click", "#submit", function() {
    if(selectedBID != -1){
	   window.location = base_url + "/bathroomview.php?bid=" + selectedBID;
    } else {
        //p("Error");
        $(".err").fadeIn(1000).show();
        $(".err").delay(3000).fadeOut(1000);
    }
});

$(document).on("change", "#building", function() {
    $("#submit").hide().fadeOut(500);

	var gender = $("#gender").val();
    var building = $("#building").val();
    var floor = $("#floor").val();    

    if (building != "None Selected"){
		populateBasedOnBuilding(building);
		return;
	}else if (floor != "None Selected"){
		populateBasedOnFloor(floor);
		return;
	}else if (gender != "None Selected"){
		populateBasedOnGender(gender);
		return;
	}else {
		$("#bathroom-list").empty();
	}
});

$(document).on("change", "#floor", function() {
    $("#submit").hide().fadeOut(500);

	var gender = $("#gender").val();
    var building = $("#building").val();
    var floor = $("#floor").val();	

    if (floor != "None Selected"){
		populateBasedOnFloor(floor);
		return;
	}else if (building != "None Selected"){
		populateBasedOnBuilding(building);
		return;
	}else if (gender != "None Selected"){
		populateBasedOnGender(gender);
		return;
	}else {
		$("#bathroom-list").empty();
	}
	
});

$(document).on("change", "#gender", function() {
    $("#submit").hide().fadeOut(500);

	var gender = $("#gender").val();
    var building = $("#building").val();
    var floor = $("#floor").val();
	
	//p("Gender called: " + gender);

	if (gender != "None Selected"){
		populateBasedOnGender(gender);
		return;
	}else if (building != "None Selected"){
		populateBasedOnBuilding(building);
		return;
	}else if (floor != "None Selected"){
		populateBasedOnFloor(floor);
		return;
	}else {
		$("#bathroom-list").empty();
	}
});

$(document).on("click", ".bathroom", function(){
    var b = $(this).data("bathroom");
    //p(b)
    selectedBID = b.bid;
    $(".highlighted").removeClass("highlighted");
    $(this).addClass("highlighted");
    //p(selectedBID)
    //
    $("#submit").show().fadeIn(3000);
});

var addBathroom = function(bid) {

    //console.log("in addBathroom: " + bid)
    // $.ajax(url_base + "/todo.php/" + id,
    // {type: "GET",
    //  dataType: "json",
    //  success: function(todo_json, status, jqXHR) {
    // 	var t = new Todo(todo_json);
    // 	$('#todo_list').append(t.makeCompactDiv());
    //     }
    // });

    $.ajax(base_url + "/php/bathrooms.php/" + bid, {
        type: "GET",
        dataType: "json",
        success: function(bathroom_json, status, jqXHR) {
            var b = new Bathroom(bathroom_json);
            //console.log(b);
            bathrooms.push(b);
        }

    });
}

var populateBasedOnBuilding = function(building) {
	var hidden = $("#bathroom-list").is(":hidden");
	if(hidden){
		$("#bathroom-list").toggleClass("hidden");
	}
    $("#bathroom-list").empty().fadeOut(1000);

    var floor = $("#floor").val();
    var gender = $("#gender").val();

    // p("B: " + building);
    // p("F: " + floor);
    // p("G: " + gender);

    // if (building == "None Selected" && floor == "None Selected" && gender == "None Selected"){
    // 	return;
    // }

    if (floor != "None Selected" && gender != "None Selected") {
        for (var i = 0; i < bathrooms.length; i++) {
            if (bathrooms[i].building == building && bathrooms[i].floor == floor && bathrooms[i].gender == gender) {
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }else if (floor == "None Selected" && gender != "None Selected"){
    	for (var i = 0; i < bathrooms.length; i++) {
            if (bathrooms[i].building == building && bathrooms[i].gender == gender) {
                
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }else if (floor != "None Selected" && gender == "None Selected"){
    	for (var i = 0; i < bathrooms.length; i++) {
            if (bathrooms[i].building == building && bathrooms[i].floor == floor) {
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }else {
    	for (var i = 0; i < bathrooms.length; i++) {
            if (bathrooms[i].building == building) {
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }
}

var populateBasedOnFloor = function(floor){
	var hidden = $("#bathroom-list").is(":hidden");
	if(hidden){
		$("#bathroom-list").toggleClass("hidden");
	}
    $("#bathroom-list").empty().fadeOut(1000);

    var building = $("#building").val();
    var gender = $("#gender").val();

    // p("B: " + building);
    // p("F: " + floor);
    // p("G: " + gender);

    // if (building == "None Selected" && floor == "None Selected" && gender == "None Selected"){
    // 	return;
    // }

    if (building != "None Selected" && gender != "None Selected") { 
    //Have all three
   	//p("Have all three");
        for (var i = 0; i < bathrooms.length; i++) {
            if (bathrooms[i].building == building && bathrooms[i].floor == floor && bathrooms[i].gender == gender) {
                //p("Match found");
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }else if (building == "None Selected" && gender != "None Selected"){ 
    //Have only floor and gender
    //p("Have only floor and gedner");
    	for (var i = 0; i < bathrooms.length; i++) {
            if (bathrooms[i].floor == floor && bathrooms[i].gender == gender) {
                //p("Match found");
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }else if (building != "None Selected" && gender == "None Selected"){ 
    //Have only building and floor
    //p("Have only building + floor");
    	for (var i = 0; i < bathrooms.length; i++) {
    		// p(bathrooms[i]);
    		// p(bathrooms[i].floor);
    		// p(bathrooms[i].building);
            if (bathrooms[i].floor == floor && bathrooms[i].building == building) {
            	//p("Match found");
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }else { 
    //Have only floor
    //p("Have only floor");
    	for (var i = 0; i < bathrooms.length; i++) {
            if (bathrooms[i].floor == floor) {
            	//p("Match found");
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }
}

var populateBasedOnGender = function(gender){
	var hidden = $("#bathroom-list").is(":hidden");
	if(hidden){
		$("#bathroom-list").toggleClass("hidden");
	}
    $("#bathroom-list").empty().fadeOut(1000);

    var building = $("#building").val();
    var floor = $("#floor").val();

    // if (building == "None Selected" && floor == "None Selected" && gender == "None Selected"){
    // 	return;
    // }

    if (building != "None Selected" && floor != "None Selected") { 
    //Have all three
   	//p("Have all three");
        for (var i = 0; i < bathrooms.length; i++) {
            if (bathrooms[i].building == building && bathrooms[i].floor == floor && bathrooms[i].gender == gender) {
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }else if (building == "None Selected" && floor != "None Selected"){ 
    //Have only gender and floor
    //p("Have only gender and floor");
    	for (var i = 0; i < bathrooms.length; i++) {
            if (bathrooms[i].gender == gender && bathrooms[i].floor == floor) {
                //p("Match found");
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }else if (building != "None Selected" && floor == "None Selected"){ 
    //Have only gender and building
    //p("Have only gender and building");
    	for (var i = 0; i < bathrooms.length; i++) {
            if (bathrooms[i].gender == gender && bathrooms[i].building == building) {
            	//p("Match found");
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }else { 
    //Have only gender
    //p("Have only gender");
    	for (var i = 0; i < bathrooms.length; i++) {
            if (bathrooms[i].gender == gender) {
            	//p("Match found");
                $("#bathroom-list").append(bathrooms[i].makeCompactDiv()).hide().fadeIn(500);
            }
        }
    }
}

//Simple shorthand for printing to console
var p = function(x){
	console.log(x);
}