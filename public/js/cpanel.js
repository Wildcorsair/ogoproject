$(document).ready(function() {
	$('#usr').click(function() {
		var tc = $('.data-block');
		$.ajax({
				//type: "GET",
				//url: "part.php",
				//dataType: "json",
				success: function() {
					tc.load("/cpanel/users");
				} 
		});
	});
	$('#usr').ajaxComplete(function() {
		alert('Request complete!');
	});

	$('#usr').ajaxError(function() {
		alert('Request error!');
	});
}); //End of ready