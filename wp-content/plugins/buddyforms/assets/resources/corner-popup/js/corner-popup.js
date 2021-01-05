/*
 * Corner Popup v1.15 - 26/7/2019
 * Author: Łukasz Brzostek
 *
 * This work is licensed under the Creative Commons
 * Attribution 4.0 International License:
 * https://creativecommons.org/licenses/by/4.0
*/

// Check for jQuery
// ----------------

if ("undefined" == typeof jQuery)
    throw new Error("Corner Popup requires jQuery");

(function($){
$.fn.cornerpopup = function(options) {

// Default plugin options
// ----------------------

var options = $.extend({
    active: 1,
    variant: 1,
    slide: 0,
    slideTop: 0,
    timeOut: 0,
    closeBtn: 1,
    shadow: 1,
    link1: "https://wp.pl",
    link2: "#",
    popupImg: "img/img-1.png",
    cookieImg: "img/cookie.png",
    messageImg: "img/icon-3.png",
    header: "Corner Popup",
    text1: 'This website uses cookies to ensure you get the best experience on our website. <a href="http://www.allaboutcookies.org" target="_blank" class="cookie-more">More information.</a>',
    text2: "This is just a sample text. Feel free to change it to your own using proper parameter.",
    button1: "more",
    button2: "Got it",
    button3: "OK",
    content: "Your own html here.",
    loadContent: "no",
    width: "390px",
    font: "'Open Sans', 'Halvetica', sans-serif",
    colors: "#543189",
    bgColor: "#fff",
    borderColor: "#efefef",
    textColor: "#181818",
    iconColor: "#543189",
    btnColor: "#543189",
    btnTextColor: "#fff",
    corners: "0px",
    position: "right",
    escClose: 0,
    beforePopup : function(){},
    afterPopup : function(){},
}, options);

    cp = "#corner-popup";

// Create/read cookie
// ------------------

function createCookie(name, value, days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    var expires = "; expires=" + date.toGMTString();
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameset = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameset) == 0) return c.substring(nameset.length, c.length);
    }
    return null;
}

// Check for slide option, set slide orientation, insert content and show popup
// ----------------------------------------------------------------------------

function popupShow() {
	options.beforePopup.call(this);
    if (options.slide == 0) {
    $(cp).html(popupContent).css("display", "flex").hide().fadeIn(800);
    } else if (options.slideTop == 1) {
    $(cp).addClass('slide-top');
    } else if (options.slide == 1 && options.position == "right") {
    $(cp).addClass('slide-left');
    } else if (options.slide == 1 && options.position == "left") {
    $(cp).addClass('slide-right');
    } else if (options.slide == 1 && options.position == "center") {
    $(cp).addClass('slide-top');
    }
    $(cp).html(popupContent).css("display", "flex").show();
}

// Check slide option, remove popup
// --------------------------------

function popupClose() {
    if (options.slide == 0) {
        $(cp).fadeOut(400, function() {
        $(this).remove();
        options.afterPopup.call(this);
    });
    } else {
        slideUndo();
    }
}

// Check slide orientation, reverse slide, remove popup after animation
// --------------------------------------------------------------------

function slideUndo() {
    if (options.slideTop == 1) {
       $(cp).removeClass("slide-top").addClass("slide-top-rev");
    } else if (options.slide == 1 && options.position == "right") {
       $(cp).removeClass("slide-left").addClass("slide-left-rev");
    } else if (options.slide == 1 && options.position == "left") {
       $(cp).removeClass("slide-right").addClass("slide-right-rev");
    } else if (options.slide == 1 && options.position == "center") {
       $(cp).removeClass("slide-top").addClass("slide-top-rev");
    }
    cpTemp = $(cp);
    cpTemp.animation = 'none';
    cpTemp.offsetHeight;
    cpTemp.animation = null;
    cpTemp.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
    cpTemp.remove();
    options.afterPopup.call(this);
    });
}

// Close popup after specified time
// --------------------------------

function timeOut(time) {
    setTimeout(function() {
    if (options.slide == 0) {                
    $(cp).fadeOut(400, function() {
    $(this).remove();
    options.afterPopup.call(this);
    });
    } else {
    slideUndo();
    }
    }, time);
}

// Check if plugin is already used and remove previous occurrences
// ---------------------------------------------------------------

    if ($(cp).length) {
    $(cp).remove();
    console.info("Corner Popup already initialized");
    }

// Add popup div into DOM if it is active
// --------------------------------------
    
    if (options.active != 0) {
    $('<div/>', { id: 'corner-popup', class: 'popup-xs' }).appendTo('body');

// Check variant and insert proper content into variable
// -----------------------------------------------------

    if (options.variant == 2) {
        if (readCookie('cp-cookies-accepted') != 'Yes') {
            popupContent = '<div class="hide-mobile col sm-4"><img src="' + options.cookieImg + '"class="corner-img-cookie responsive"></div><div class="col xs-12 sm-8"><div class="corner-close close-change"></div><div class="corner-container"><p class="corner-text">' + options.text1 + '</p><a class="corner-btn-cookie">' + options.button2 + '</a></div></div>';
        } else {
            $(cp).remove();
        }
    } else if (options.variant == 3) {
        popupContent = '<div class="hide-mobile col sm-4"><img src="' + options.messageImg + '"class="corner-img-cookie responsive"></div><div class="col xs-12 sm-8"><div class="corner-close close-change"></div><div class="corner-container"><p class="corner-text">' + options.text2 + '</p><a href="' + options.link2 + '" class="corner-btn-close">' + options.button3 + '</a></div></div>';
    } else if (options.variant == 4) {
        popupContent = '<div class="hide-mobile col sm-4"><img src="' + options.messageImg + '"class="corner-img-cookie responsive"></div><div class="col xs-12 sm-8"><div class="corner-close close-change"></div><div class="corner-container-1"><p class="corner-text">' + options.text2 + '</p></div></div>';
    } else if (options.variant == 5) {
        popupContent = '<div class="col sm-12"><div class="corner-close close-change1"></div><div class="corner-container-1"><p class="corner-text">' + options.text2 + '</p></div></div>';
    } else if (options.variant == 6) {
        popupContent = '<div class="col sm-12"><div class="corner-close close-change1"></div><div class="corner-container-2"><p class="corner-text">' + options.text2 + '</p><a href="' + options.link2 + '" class="corner-btn-close">' + options.button3 + '</a></div></div>';
    } else if (options.variant == 7) {
        popupContent = '<div class="col sm-12"><div class="corner-close close-change1"></div><div class="corner-container-1"><p class="corner-head head-center">' + options.header + '</p></div></div>';
    } else if (options.variant == 8) {
        popupContent = '<div class="col sm-12"><div class="corner-close close-change1"></div><div class="corner-container-1"><p class="corner-head">' + options.header + '</p><p class="corner-text">' + options.text2 + '</p></div></div>';
    } else if (options.variant == 9) {
        popupContent = '<div class="col sm-12"><div class="corner-close close-change1"></div><div class="corner-container-2"><p class="corner-head">' + options.header + '</p><p class="corner-text">' + options.text2 + '</p><a href="' + options.link2 + '" class="corner-btn-close">' + options.button3 + '</a></div></div>';
    } else if (options.variant == 10) {
        popupContent = '<div class="col sm-12"><div class="corner-close close-change1"></div><div class="corner-container">' + options.content + '</div></div>';
    } else {
        popupContent = '<div class="hide-mobile col sm-6"><a href="' + options.link1 + '"><img src="' + options.popupImg + '"class="corner-img responsive"></a></div><div class="col xs-12 sm-6"><div class="corner-close"></div><div class="corner-container"><p class="corner-head">' + options.header + '</p><a href="' + options.link1 + '" class="corner-btn">' + options.button1 + '</a></div></div>';
    }

// Popup show 
// ----------

    popupShow();

// Load personal html content
// --------------------------

    if (options.variant == 10 && options.loadContent !== "no") 
    $(".corner-container").load(options.loadContent);

// Close button visibility
// -----------------------

    if (options.closeBtn !== 1) {
        $(".corner-close").remove();
        if ($(window).width() > 768) {
        $(cp).css("right", "70px");
        }
        $(".corner-container").css({
            "bottom": "15px",
            "padding-top": "30px"
        });
        $(".corner-container-1").css({
            "bottom": "0",
            "padding-bottom": "10px",
            "padding-top": "20px"
        });
        $(".corner-container-2").css({
            "bottom": "12px",
            "padding-top": "30px"
        });
    }

// Shadow visibility
// -----------------

    if (options.shadow !== 1)
        $(cp).css("box-shadow", "none");

// Popup width
// -----------

    if (options.width !== "390px") 
        $(cp).css("width", options.width);

// Popup font
// ----------

    if (options.font !== "'Open Sans', 'Halvetica', sans-serif")
        $(cp).css("font-family", options.font);

// Popup colors
// ------------

    if (options.colors !== "#543189") {
        $(".corner-btn, .corner-btn-cookie, .corner-btn-close").css("background-color", options.colors);
        $(".corner-head, .cookie-more").css("color", options.colors);
        $(cp).after('<style>#corner-popup .corner-close:after{background-color:' + options.colors + ';}\n#corner-popup .corner-close:before{background-color:' + options.colors + ';} </style>');
    }

// Popup background color
// ----------------------

    if (options.bgColor !== "#fff")
        $(cp).css("background-color", options.bgColor);

// Popup border color
// ------------------

    if (options.borderColor !== "#efefef")
        $(cp).css("border-color", options.borderColor);

// Popup text color
// ----------------

    if (options.textColor !== "#181818")
        $(".corner-text, .corner-head, .corner-container").css("color", options.textColor);

// Popup icon colors
// -----------------

    if (options.iconColor !== "#543189") {
        $("body").append("<style></style>");
        $("style").html('#corner-popup .corner-close:after{background-color:' + options.iconColor + ';}\n#corner-popup .corner-close:before{background-color:' + options.iconColor + ';');
    }

// Popup button color
// ------------------

    if (options.btnColor !== "#543189")
        $(".corner-btn, .corner-btn-close, .corner-btn-cookie").css("background-color", options.btnColor);

// Popup button text color
// -----------------------

    if (options.btnTextColor !== "#fff")
        $(".corner-btn, .corner-btn-close, .corner-btn-cookie").css("color", options.btnTextColor);

// Popup corner radius
// -------------------

    if (options.corners !== "0px")
        $(cp).css("border-radius", options.corners);

// Popup position
// --------------

    if (options.position !== "right") {
        if (options.position == "left" && $(window).width() > 768) {
        $(cp).css({
            "right": "0",
            "left": "60px"
        });
    } else {
        $(cp).css({
            "right": "0",
            "left": "0",
            "margin": "0 auto"
        });
    }
    }

// Popup timeout
// -------------    

    if (options.timeOut !== 0)
        timeOut(options.timeOut);

// Popup close
// ----------- 

    $(".corner-close, .corner-btn-close, .corner-btn-cookie").click(function() {
        popupClose();       
    });

    $(".corner-btn-cookie").click(function() {
        createCookie('cp-cookies-accepted', 'Yes', 365);
    });

// Close on ESC key press
// ----------------------

    $(document).keyup(function(e) {
        if (options.escClose != 0 && (e.key === "Escape" || e.keyCode == 27))
        popupClose();
    });

// Public functions
// ----------------

    $.fn.cornerpopup.popupClose = function() {
        popupClose();
    }

}
};
})(jQuery);