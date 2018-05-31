$(document).ready(function(){
    'use strict';

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('#itemslider').carousel({ interval: 3000 });

    $('.carousel-showmanymoveone .item').each(function(){
        var itemToClone = $(this);

        for (var i=1;i<4;i++) {
            itemToClone = itemToClone.next();

            if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
            }

            itemToClone.children(':first-child').clone()
                .addClass("cloneditem-"+(i))
                .appendTo($(this));
        }
    });

    imagePreview();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });


});

/*
 * Image preview script
 * powered by jQuery (http://www.jquery.com)
 *
 * written by Alen Grakalic (http://cssglobe.com)
 *
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
function log(str, params) {
    var s = [str.length * 2];
    for (var i = 0; i < str.length; ++i) {
        s[i*2] = str[i];
        s[i*2 + 1] = params[i];
    }

    $("#log").val(s.join(""));
}

this.imagePreview = function(){
	/* CONFIG */

    xOffset = 15;
    yOffset = 30;

    // these 2 variable determine popup's distance from the cursor
    // you might want to adjust to get the right result
    var Mx = $(document).width();
    var My = $(document).height();

	/* END CONFIG */
    var callback = function(event) {
        var $img = $("#preview");

        // top-right corner coords' offset
        var trc_x = xOffset + $img.width();
        var trc_y = yOffset + $img.height();

        trc_x = Math.min(trc_x + event.pageX, Mx);
        trc_y = Math.min(trc_y + event.pageY, My);

        log(
            ["[",";","](",";",") x: ", "; y: "],
            [Mx, My, event.pageX, event.pageY, trc_x, trc_y]);
        $img
            .css("top", (trc_y - $img.height()) + "px")
            .css("left", (trc_x - $img.width())+ "px");
    };

    $("a.preview").hover(function(e){
            Mx = $(document).width();
            My = $(document).height();

            this.t = this.title;
            this.title = "";
            var c = (this.t != "") ? "<br/>" + this.t : "";
            $("body").append("<p id='preview'><img src='"+ this.href +"' alt='Image preview' />"+ c +"</p>");
            callback(e);
            $("#preview").fadeIn("fast");
        },
        function(){
            this.title = this.t;
            $("#preview").remove();
        }
    )
        .mousemove(callback);
};


$(window).scroll(function () {
    //if you hard code, then use console
    //.log to determine when you want the
    //nav bar to stick.
    'use strict';
    if ($(window).scrollTop() > 150) {
        $('.header').addClass('fix_header');
    }
    if ($(window).scrollTop() < 150) {
        $('.header').removeClass('fix_header');
    }
});


