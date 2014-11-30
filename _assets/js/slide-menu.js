/**
 * The nav stuff
 */

$(function(){
    var mask = '<div class="mask"></div>';

    $('.toggle-slide').click(function(e){
        $('body').addClass('sm-open').append(mask);
    });

    $(document).on('click', '.mask', function(e){
        closeSlideNav();
    });

    $('.close-slide, .alt-close-slide').click(function(e){
        closeSlideNav();
    });

});

function closeSlideNav(){
    $('body').removeClass('sm-open');
    $('.mask').remove(); 
}