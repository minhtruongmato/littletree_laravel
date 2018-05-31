$(document).ready(function() {
    "use strict";

    var n = $(window).width(); //Check Device's Width
    if (n <= 970){
        $('ul.nav').hide();

        var nav_check = 1;
        $('.nav_list button#expand_btn').click(function(){
            if (nav_check === 1){
                $('ul.nav').slideDown();
                $('.main_nav button#expand_btn i').removeClass('fa-bars').addClass('fa-close');
                nav_check = 0;
            } else {
                $('ul.nav').slideUp();
                $('.main_nav button#expand_btn i').removeClass('fa-close').addClass('fa-bars');
                nav_check = 1;
            }
        });

        var ul_drop = 1;
        $('.nav_list li a.ul_expand').click(function(){
            if (ul_drop === 1){
                $('ul.ul_dropdown').slideDown();
                ul_drop = 0;
            } else {
                $('ul.ul_dropdown').slideUp();
                ul_drop = 1;
            }
        })

    } else {
        $('ul.nav').show();
    }

    // Script for Search Box

    $('#search_box').hide();

    var i = 1;
    $('header #search_btn').click(function(){
        if ( i === 1){
            $('#search_box').slideDown();
            i = 0;
        } else {
            $('#search_box').slideUp();
            i = 1;
        }
    });
});