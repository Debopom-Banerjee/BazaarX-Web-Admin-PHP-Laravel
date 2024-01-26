"use strict";
$(document).ready(function() {
    // Single swithces
    var elemsingle = document.querySelector('.js-single');
   if(elemsingle != null){
       var switchery = new Switchery(elemsingle, {
           color: '#4099ff',
           jackColor: '#fff'
       });
   }
    // Multiple swithces
    var elem = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elem.forEach(function(html) {
        var switchery = new Switchery(html, {
            color: '#4099ff',
            jackColor: '#fff',
            size: 'small'
        });
    });
    // Disable enable swithces
    var elemstate = document.querySelector('.js-dynamic-state');
    if(elemsingle != null){
        var switcheryy = new Switchery(elemstate, {
            color: '#4099ff',
            jackColor: '#fff'
        });
    }

    $('.switch-input').on('click', function (e) {
        var content = $(this).closest('.switch-content');
        if (content.hasClass('d-none')) {
            $(this).attr('checked', 'checked');
            content.find('input').attr('required', true);
            content.removeClass('d-none');
        } else {
            content.addClass('d-none');
            content.find('input').attr('required', false);
        }
    });
});