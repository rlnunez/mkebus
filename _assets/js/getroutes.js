
$(function(){
    $.getJSON('/_assets/json/getroutes.php', function(data){
        $('#rt, #bus-rt-num')
            .append($('<option></option>')
            .attr('value', '')
            .attr('selected', 'selected')
            .text('Route'));

        $.each(data, function(i, v){
            var $optrt = $('<option></option>')
                            .attr('value', v.rt)
                            .text(v.rt);
            if (selectRT == v.rt) {
                $optrt.attr('selected', 'selected');
            }
            $('#rt, #bus-rt-num').append($optrt);
        });
    });
});

