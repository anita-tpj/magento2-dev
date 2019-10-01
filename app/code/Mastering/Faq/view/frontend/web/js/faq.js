/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 16.9.2019.
 * Time: 14:06
 */

define([
    'jquery',
    'jquery/ui'
], function ($) {
    "use strict";

    if ($(window).width() > 767) {
        $(document).on('click', 'a[href^="#"]', function (event) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top - 65
            }, 1000);
        });
    }

    $(document).on('click', '.faq-form-link', function () {
        $('.customer-form-wrap').slideToggle();
    });

    $(document).ready(function ($) {
        $('.faq-title-item').each(function () {
            var self = $(this),
                includeSelfHtml = '<div class="faq-title-item">' + self.html() + '</div>';
            if (self.hasClass('faq-right-item')) {
                $('.faq-list-right').append(includeSelfHtml);
            } else {
                $('.faq-list-left').append(includeSelfHtml);
            }
            self.remove();
        });
    });
});
