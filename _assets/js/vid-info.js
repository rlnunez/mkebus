$('#vid-btn').click(function(e){
	hash.vid 	= $('#vid-num').val();
	newHash(hash);

	$('#info-container').fadeIn('slow');
});