$('.list-group').on('click', '.btn-rt', function(e){
  hash.vid = $(this).attr('data-vid'),
  des      = $(this).attr('data-des'),
  rt       = $(this).attr('data-rt'),
  businfo  = rt + ': ' + des;
  newHash(hash);
  hash     = hashtoObj(window.location.hash);
  $('.bus-des-info').text(businfo);
  $('#info-container').fadeIn('slow');
  $('.close-info').fadeIn('slow');
  window.scrollTo(0,0);
});

$('.close-info').click(function(e){
    clearTimer();
    $('#info-container').fadeOut('slow');
    $('.close-info').fadeOut('slow');
    $('.bus-des-info').text('');
});

/*
  .on('hidden.bs.modal', function(){
    // Remove the map and delete the object
    clearTimer();
  });
*/