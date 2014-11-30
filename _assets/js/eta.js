    $('.list-group').on('click', '.btn-rt', function(e) {
        e.preventDefault();
        $('#loadingSpinner').show();
        var vid         = $(this).attr('data-vid'),
            currentstop = hash.stpid
            etaTime     = '#eta-time';
        $('#eta-select,' + etaTime).empty();
        $.getJSON('/_assets/json/eta.php?vid=' + vid + '&currentstop=' + currentstop, function(data) {
                $.each(data, function(i, v) {
                        $('#eta-select')
                            .append($('<option></option>')
                            .attr('value', v['stpid'])
                            .text(v['stpnm']));
                });
        });
         $('#loadingSpinner').hide();
    });   

    $("#eta-select").change(function() {
        $('#loadingSpinner').show();
        var myStop  = $(this).val(),
            etaTime = '#eta-time';
        $.getJSON('/_assets/json/predictions.php?rt=' + hash.rt + '&stid=' + myStop, function(data) {
            var predictions = data['prd'],
                predtime = '';
                console.log(data);
            $.each(predictions, function(i, v) {
                if (v.vid == vid) {
                    predtime = v.prdtm;
                }
            });
            if (predtime != '') {
                predtime = formatTime(predtime);
            } else {
                $.each(predictions, function(i, v) {
                    if (v.vid == '' && v.des == des) {
                        predtime = v.prdtm;
                        return false;
                    }
                });
                if (predtime != '') {
                    predtime = formatTime(predtime);
                    predtime = predtime + ' <em>Planned Arrival</em>';
                } else {
                    predtime = 'Unable to locate a possible ETA'
                }
            }
            $(etaTime).html(predtime);
        });
        $('#loadingSpinner').hide();
    });

    function formatTime(predtime) {
        var time = predtime.split(' ');
        time = time[1].split(':');
        var hours = time[0],
            minutes = time[1],
            ampm = 'AM';
        if (hours > 12) {
            hours = parseInt(hours) - 12;
            ampm = 'PM';
        }
        predtime = hours + ':' + minutes + ampm;
        return predtime;
    }