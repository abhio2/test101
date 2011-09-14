<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Search Flickr Images</title>
<script src="jquery-1.6.4.js"></script>
</head>
<body>
	

<center width="800px">
<h2> Flickr Image Search</h2>
<form>
	<div>
		<label>Enter keyword</label>
		<input type="text" name="search" id="search" value="" />
		<input type="button" name="submit" id="searchBtn" value="Search" />
	</div>					
</form>
<div id="result"></div
</center>

</body>

<script>
$(document).ready(function(){
	$('#searchBtn').click(function() { 
		var searchVal = $('#search').val();
		$.ajax({
			type: 'GET',
			url: 'getFlickr.php',
			data: 'search=' + searchVal,
			dataType: 'html',
			beforeSend: function() {
				$('#result').html('<img src="loading.gif" alt="loading..." />');
				if(!searchVal[0]) {
					$('#result').html('<p>Please enter a keyword as search value.</p>');   	
					return false;
				} 	
			},
			success: function(response) {
				$('#result').html(response);
				
			}
		});
	});


	$('.paginate').live('click', function(e) {
		
		 var page = $(this).closest('span').attr('id'); 
		 //alert(page);
		 var searchVal = $('#search').val();
			$.ajax({
				type: 'GET',
				url: 'getFlickr.php',
				data: 'search=' + searchVal+'&page='+page,
				dataType: 'html',
				beforeSend: function() {
					$('#result').html('<img src="loading.gif" alt="loading..." />');
					if(!searchVal[0]) {
						$('#result').html('<p>Please enter a keyword as search value.</p>');   	
						return false;
					} 	
				},
				success: function(response) {
					$('#result').html(response);
					
				}

			});
	});
		


		 
});

</script>
</html>	
	
