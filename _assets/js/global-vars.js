var updateListvar,
    hash        = hashtoObj(window.location.hash),
    selectRT    = '',
    des         = '';

$(function(){                   
	if(typeof hash.stpid != 'undefined'){
    	$('#stid').val(hash.stpid);
            clearListUpdate();
            updateList();
            updateListvar = setInterval(
				function(){ 
					updateList();
				}, 60000);
            }
    if (typeof hash.rt != 'undefined') {
        selectRT = hash.rt   
    } 
});

function hashtoObj(urlhash){
    urlhash = urlhash.replace('#', '');
    urlhash = urlhash.split('&');
    var easyhash = {};
    if (urlhash != '') {
	    $.each(urlhash, function(k, v){
	        var tempkey = v.split('=');
	        if(tempkey[0].length > 0){
	        	easyhash[tempkey[0]] = tempkey[1];
	        }
	    }); 	
    }
    return easyhash;
}