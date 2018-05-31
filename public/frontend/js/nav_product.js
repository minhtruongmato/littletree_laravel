$(document).ready(function() {
    'use strict';

    $('li.nav_product_hover a').click(function(){
        alert('fuck');
        $('div.nav_expand').fadeIn();
    });

});