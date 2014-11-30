$('#rt-dir').change(function(e){
    updateStops($('#bus-rt-num').val(), $('#rt-dir').val());
    hash.rt = $('#bus-rt-num').val();
    hash.dir = $('#rt-dir').val();
    newHash(hash);
});

$(function(){
    updateStops();
});

function updateStops(rt, dir) {
    rt = typeof rt !== 'undefined' ? rt : hash.rt;
    dir = typeof dir !== 'undefined' ? dir : hash.dir;
    var dURL    = '/_assets/json/stops.php?rt=' + rt + '&dir=' + dir;
    $.getJSON(dURL, function(data) {
        $('#rt-stop').empty();
        $.each(data, function(i, v){
            var $optrt = $('<option></option>')
                            .attr('value', v.stpid)
                            .text(v.stpnm);
            $('#rt-stop').append($optrt);
        });
    });
}