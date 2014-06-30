var url_base = "http://cihsp.github.io/php";
var reviewCount = 0;
$(document).ready(function () {
	bid = $('#bid').val();

	// Load review list and display it
	$.ajax(url_base + "/bathrooms.php/"+bid+"/reviews/",
		{type: "GET",
		dataType: "json",
		success: function(review_ids, status, jqXHR) {
			if (review_ids===null) {
				$('#review_list').html("No Reviews yet");
			}else{
				reviewCount = review_ids.length;
			}
		},
		error: function(jqXHR, status, error) {
			window.location.href = "http://cihsp.github.io";
		}});

	$.ajax(url_base + "/bathrooms.php/"+bid,
		{type: "GET",
		dataType: "json",
		success: function(bathroom_json, status, jqXHR) {
			bathroom_json.count = reviewCount;
			br = new Bathroom(bathroom_json);
			$('#bathroomHeader').html(br.makeHeader());
		},
		error: function(jqXHR, status, error) {
			window.location.href = "http://cihsp.github.iox";
		}});

	// Add new review 
	$('#new_review_form').on('submit',
		function (e) {
			e.preventDefault();
			$.ajax(url_base + "/reviews.php/",
				{type: "POST",
				dataType: "json",
				data: $(this).serialize(),
				success: function(review_json, status, jqXHR) {
					window.location.href = "http://cihsp.github.io/bathroomview.php?bid="+bid;
				},
				error: function(jqXHR, status, error) {
					// alert("faliure:"+jqXHR.responseText);
				}});
		});
});

