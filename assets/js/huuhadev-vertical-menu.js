function showDropdown(e) {
    if(!e.hasClass('has-dropdown')){
        return false;
    }
    e.addClass("current-dropdown"),
        (function (navDropdown) {
            var dropdown = navDropdown,
                menuWrapWidth = jQuery(".menu-inner").width(),
                verticalMenuWrap = dropdown.closest('.huuhadev-vertical-menu'),
                submenuItem = dropdown.closest("div.ux-menu-link");
            if (menuWrapWidth < 750) return !1;
            // var dropdownOffset = dropdown.offset();
            // var windowWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
            // var dropdownWidth = dropdown.width();
            dropdown.css("width", menuWrapWidth - submenuItem.outerWidth());
            //dropdown.children().css( "height", verticalMenuWrap.outerHeight() );
            //dropdown.css("height", verticalMenuWrap.outerHeight());
        })(e.find(".nav-dropdown"));
}

function hideDropdown(dropdown) {
    dropdown.removeClass("current-dropdown"), dropdown.find(".nav-dropdown").attr("style", "");
}

function resetDropdown() {
    jQuery('.has-dropdown').each(function (index, element) {
        var dropdown = jQuery(element);
        dropdown.hasClass("current-dropdown") && hideDropdown(dropdown);
    });
}

Flatsome.behavior('huuhadev-vertical-menu', {
    attach: function (context) {
        jQuery(".vertical-menu div.ux-menu-link", context).each(function (index, element) {
            'use strict'
            var menuItem = jQuery(element),
                behaviorClick = menuItem.closest('.vertical-menu').hasClass("nav-dropdown-click");
            if(index == 0){
                showDropdown(menuItem);
            }
            menuItem.attr('id','hhd-menu-item-'+ (index+1));

            if(behaviorClick){
                menuItem.on("click", "a:first", function (e) {
                    var hasDropdown = menuItem.hasClass('has-dropdown');
                    if(hasDropdown){
                        resetDropdown();
                        showDropdown(menuItem);
                        e.preventDefault();
                    }
                });
            }else{
                menuItem.hoverIntent({
                    sensitivity: 3,
                    interval: 20,
                    timeout: 70,
                    over: function (e) {
                        showDropdown(jQuery(element));
                    },
                    out: function () {
                        hideDropdown(jQuery(element));
                    },
                });
            }
        });
    },
});

jQuery(document).ready(function () {
});
