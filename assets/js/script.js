// some scripts

// jquery ready start
$(document).ready(function() {
	// jQuery code


    /* ///////////////////////////////////////

    THESE FOLLOWING SCRIPTS ONLY FOR BASIC USAGE, 
    For sliders, interactions and other

    */ ///////////////////////////////////////

    lazyload();


	//////////////////////// Prevent closing from click inside dropdown
    $(document).on('click', '.dropdown-menu', function (e) {
      e.stopPropagation();
    });


    $('.js-check :radio').change(function () {
        var check_attr_name = $(this).attr('name');
        if ($(this).is(':checked')) {
            $('input[name='+ check_attr_name +']').closest('.js-check').removeClass('active');
            $(this).closest('.js-check').addClass('active');
           // item.find('.radio').find('span').text('Add');

        } else {
            item.removeClass('active');
            // item.find('.radio').find('span').text('Unselect');
        }
    });


    $('.js-check :checkbox').change(function () {
        var check_attr_name = $(this).attr('name');
        if ($(this).is(':checked')) {
            $(this).closest('.js-check').addClass('active');
           // item.find('.radio').find('span').text('Add');
        } else {
            $(this).closest('.js-check').removeClass('active');
            // item.find('.radio').find('span').text('Unselect');
        }
    });



	//////////////////////// Bootstrap tooltip
	if($('[data-toggle="tooltip"]').length>0) {  // check if element exists
		$('[data-toggle="tooltip"]').tooltip()
	} // end if


    // Keep the AJAX-powered #cart_items in the original header; it remains above the drawer.
    var $mobileDrawer = $('#leatherket-mobile-menu');
    var $menuButton = $('.menu-toggle');

    function setMobileDrawer(isOpen) {
        if (!$mobileDrawer.length) return;

        if (isOpen) {
            // The existing header is repositioned above the drawer only while it is open.
            var headerHeight = Math.ceil($('.section-header .header-main').outerHeight() || 49);
            document.documentElement.style.setProperty('--leatherket-mobile-header-height', headerHeight + 'px');
            $('.search-box').removeClass('show');
        }

        $mobileDrawer.toggleClass('show', isOpen).toggleClass('hide', !isOpen)
                     .attr('aria-hidden', isOpen ? 'false' : 'true');
        $menuButton.toggleClass('collapsed', isOpen)
                   .attr('aria-expanded', isOpen ? 'true' : 'false')
                   .attr('aria-label', isOpen ? 'Close menu' : 'Open menu');
        $('body').toggleClass('mobile-nav-open', isOpen);

        if (!isOpen) {
            document.documentElement.style.removeProperty('--leatherket-mobile-header-height');
        }
    }

    $(document).on('click', '.menu-toggle', function (event) {
        event.preventDefault();
        setMobileDrawer(!$mobileDrawer.hasClass('show'));
    });

    // Search takes precedence over navigation, and stays usable on small screens.
    $('.nav-search-box a').on('click', function (event) {
        event.preventDefault();
        setMobileDrawer(false);
        $('.search-box').addClass('show');
        $('.search-box input[type="text"]').focus();
    });
    $('.search-box-back button').on('click', function () {
        $('.search-box').removeClass('show');
    });

    // Capture phase also catches Escape when Bootstrap's cart dropdown stops bubbling.
    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') return;
        if ($mobileDrawer.hasClass('show')) {
            setMobileDrawer(false);
            $menuButton.focus();
        } else {
            $('.search-box').removeClass('show');
        }
    }, true);

    // Dismiss navigation at desktop widths; refresh offset when mobile rotates.
    $(window).on('resize', function () {
        if (window.innerWidth >= 992) {
            setMobileDrawer(false);
        } else if ($mobileDrawer.hasClass('show')) {
            document.documentElement.style.setProperty(
                '--leatherket-mobile-header-height',
                Math.ceil($('.section-header .header-main').outerHeight() || 49) + 'px'
            );
        }
    });

    // Links continue to use the database-backed Category Menu.
    $mobileDrawer.on('click', '.mobile-nav-categories a', function () {
        setMobileDrawer(false);
    });


    const galleryThumbnail = document.querySelectorAll(".thumbnails-list li");
// select featured
const galleryFeatured = document.querySelector(".product-gallery-featured img");

// loop all items
galleryThumbnail.forEach((item) => {
  item.addEventListener("mouseover", function () {
    let image = item.children[0].src;
    galleryFeatured.src = image;
  });
});

// show popover
$(".main-questions").popover('show');


var s = $("#lightbox");
$('[data-target="#lightbox"]').on("click", function(t) {
    var e = $(this).find("img"),
        a = e.attr("src"),
        i = e.attr("alt")
        o = {
            maxWidth: $(window).width() - 10,
            maxHeight: $(window).height() - 10
        };
    s.find(".close").addClass("hidden"), s.find("img").attr("src", a), s.find("img").attr("alt", i);
}), s.on("shown.bs.modal", function(t) {
    var e = s.find("img");
    s.find(".modal-dialog").css({
        width: e.width()
    }),s.find(".close").removeClass("hidden"), s.addClass("fade"), $(".modal-backdrop").addClass("fade")
}), s.on("hide.bs.modal", function(e) {
    s.find(".modal-content").removeClass("swal2-show").addClass("swal2-hide");
    s.removeClass("fade");

}), s.on("hidden.bs.modal", function(e) {
    e.preventDefault();
});

    $(".btn-number").click(function (e) {
        e.preventDefault();

        fieldName = $(this).attr("data-field");
        type = $(this).attr("data-type");
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());

        if (!isNaN(currentVal)) {
            if (type === "minus") {
                if (currentVal > input.attr("min")) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) === input.attr("min")) {
                    $(this).attr("disabled", true);
                }
            } else if (type === "plus") {
                if (currentVal < input.attr("max")) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr("max")) {
                    $(this).attr("disabled", true);
                }
            }
        } else {
            input.val(0);
        }
    });
}); 
// jquery end

