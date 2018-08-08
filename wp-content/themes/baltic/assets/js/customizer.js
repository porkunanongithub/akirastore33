/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function($, api) {

    // Site title and description.
    api('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });
    api('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });

    // Header text color.
    api('header_textcolor', function(value) {
        value.bind(function(to) {
            if ('blank' === to) {
                $('.site-title, .site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title, .site-description').css({
                    'clip': 'auto',
                    'position': 'relative'
                });
                $('.site-title a, .site-description, .site-header-extra a, .main-navigation ul.menu>.menu-item>a').css({
                    'color': to
                });
            }
        });
    });

    api('header_image', function(value) {
        value.bind(function(to) {
            $('.site-header').css('background-image', 'url(' + to + ')');
        });
    });

    api('show_preloader', function(value) {
        value.bind(function(to) {
            if (to === true) {
                $('.site-preloader').css({
                    'display': 'block'
                });
                $('.js .preloader-enabled').css({
                    'overflow': 'hidden'
                });
            } else {
                $('.site-preloader').css({
                    'display': 'none'
                });
                $('.js .preloader-enabled').css({
                    'overflow': 'visible'
                });
            }
        });
    });

    api('meta_date', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('.entry-meta .posted-on').css({
                    'display': 'inline-block'
                });
            } else {
                $('.entry-meta .posted-on').css({
                    'display': 'none'
                });
            }
        });
    });

    api('meta_author', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('.entry-meta .byline').css({
                    'display': 'inline-block'
                });
            } else {
                $('.entry-meta .byline').css({
                    'display': 'none'
                });
            }
        });
    });

    api('meta_categories', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('.entry-footer .cat-links').css({
                    'display': 'inline-block'
                });
            } else {
                $('.entry-footer .cat-links').css({
                    'display': 'none'
                });
            }
        });
    });

    api('meta_tags', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('.entry-footer .tags-links').css({
                    'display': 'inline-block'
                });
            } else {
                $('.entry-footer .tags-links').css({
                    'display': 'none'
                });
            }
        });
    });

    api('meta_comment', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('.entry-footer .comments-link').css({
                    'display': 'inline-block'
                });
            } else {
                $('.entry-footer .comments-link').css({
                    'display': 'none'
                });
            }
        });
    });

    api('author_profile', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('.author-info').css({
                    'display': 'block'
                });
            } else {
                $('.author-info').css({
                    'display': 'none'
                });
            }
        });
    });

    api('layout_archive', function(value) {

        value.bind(function(to) {

            var bodyEl = $('body.archive'),
                secondaryEl = $('#secondary');

            if (to === 'content-sidebar') {
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('full-width');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('content-sidebar');
                secondaryEl.css('display', 'block');
            } else if (to === 'sidebar-content') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('full-width');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('sidebar-content');
                secondaryEl.css('display', 'block');
            } else if (to === 'full-width') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('full-width');
                secondaryEl.css('display', 'none');
            } else if (to === 'narrow') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('full-width');
                bodyEl.addClass('narrow');
                secondaryEl.css('display', 'none');
            }

        });

    });

    api('layout_post', function(value) {

        value.bind(function(to) {

            var bodyEl = $('body.single-post'),
                secondaryEl = $('#secondary');

            if (to === 'content-sidebar') {
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('full-width');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('content-sidebar');
                secondaryEl.css('display', 'block');
            } else if (to === 'sidebar-content') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('full-width');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('sidebar-content');
                secondaryEl.css('display', 'block');
            } else if (to === 'full-width') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('full-width');
                secondaryEl.css('display', 'none');
            } else if (to === 'narrow') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('full-width');
                bodyEl.addClass('narrow');
                secondaryEl.css('display', 'none');
            }

        });

    });

    api('layout_page', function(value) {

        value.bind(function(to) {

            var bodyEl = $('body.page'),
                secondaryEl = $('#secondary');

            if (to === 'content-sidebar') {
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('full-width');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('content-sidebar');
                secondaryEl.css('display', 'block');
            } else if (to === 'sidebar-content') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('full-width');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('sidebar-content');
                secondaryEl.css('display', 'block');
            } else if (to === 'full-width') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('full-width');
                secondaryEl.css('display', 'none');
            } else if (to === 'narrow') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('full-width');
                bodyEl.addClass('narrow');
                secondaryEl.css('display', 'none');
            }

        });

    });

    api('layout_products', function(value) {

        value.bind(function(to) {

            var bodyEl = $('body.archive.woocommerce'),
                secondaryEl = $('#secondary');

            if (to === 'content-sidebar') {
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('full-width');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('content-sidebar');
                secondaryEl.css('display', 'block');
            } else if (to === 'sidebar-content') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('full-width');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('sidebar-content');
                secondaryEl.css('display', 'block');
            } else if (to === 'full-width') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('full-width');
                secondaryEl.css('display', 'none');
            } else if (to === 'narrow') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('full-width');
                bodyEl.addClass('narrow');
                secondaryEl.css('display', 'none');
            }

        });

    });

    api('layout_product', function(value) {

        value.bind(function(to) {

            var bodyEl = $('body.single.woocommerce'),
                secondaryEl = $('#secondary');

            if (to === 'content-sidebar') {
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('full-width');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('content-sidebar');
                secondaryEl.css('display', 'block');
            } else if (to === 'sidebar-content') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('full-width');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('sidebar-content');
                secondaryEl.css('display', 'block');
            } else if (to === 'full-width') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('narrow');
                bodyEl.addClass('full-width');
                secondaryEl.css('display', 'none');
            } else if (to === 'narrow') {
                bodyEl.removeClass('content-sidebar');
                bodyEl.removeClass('sidebar-content');
                bodyEl.removeClass('full-width');
                bodyEl.addClass('narrow');
                secondaryEl.css('display', 'none');
            }

        });

    });

    api('footer_credits', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('.site-designer').css({
                    'display': 'block'
                });
            } else {
                $('.site-designer').css({
                    'display': 'none'
                });
            }
        });
    });

    api('return_top', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('.return-to-top').css({
                    'display': 'block'
                });
            } else {
                $('.return-to-top').css({
                    'display': 'none'
                });
            }
        });
    });

})(jQuery, wp.customize);
