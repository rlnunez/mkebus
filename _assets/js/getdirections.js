$('#bus-rt-num').change(function(e){
    updateDIR($('#bus-rt-num').val());
    hash.rt = $('#bus-rt-num').val();
    newHash(hash);
});

$(function(){
    updateDIR();
});

function updateDIR(rt) {
    rt = typeof rt !== 'undefined' ? rt : hash.rt;
    var dURL    = '/_assets/json/directions.php?rt=' + rt;
    $.getJSON(dURL, function(data) {
        $('#rt-dir').empty();
        $.each(data, function(i, v){
            var $optrt = $('<option></option>')
                            .attr('value', v.dir)
                            .text(v.dir);
            $('#rt-dir').append($optrt);
        });
        updateStops(hash.rt, $('#rt-dir').val());
    });
}