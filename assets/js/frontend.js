/* global google, grecaptcha */

import $ from 'jquery';

$(document).ready(function () {
    'use strict';

    let Frontend = {
        googleMap: function (holderId) {
            let el = $('#' + holderId);

            function createMap(mapBlock, latitude, longitude, link) {
                let mapElement = document.getElementById(mapBlock);
                if (mapElement) {
                    //change marker on google map
                    let map = new google.maps.Map(document.getElementById(mapBlock), {
                        zoom: 15,
                        center: new google.maps.LatLng(latitude, longitude),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    let marker = new google.maps.Marker({
                        position: new google.maps.LatLng(latitude, longitude),
                        map: map,
                        title: 'BazarMcBean',
                        clickable: true
                    });

                    google.maps.event.addListener(marker, 'click', function () {
                        if (link !== '') {
                            window.open(link);
                        }
                    });
                }
            }

            createMap(holderId, el.data('lat'), el.data('long'), el.data('link'));
        },

        modal: function () {
            let modal = $('.venobox').venobox({
                bgcolor: '',
                border: ''
            });

            $(document).on('click', '.vbox-close-btn', function (e) {
                modal.VBclose();
            });
        },

        menuOverlay: function () {
            $(".menu-list > li.has-menu").hover(
                function () {
                    $("body").addClass("overlay");
                }, function () {
                    $("body").removeClass("overlay");
                }
            );
        },

        testimonialsSlider: function () {
            $('.testimonials-slider').slick({
                autoplay: true,
                arrows: false,
                dots: true,
                slidesToShow: 1
            });
        },

        headerScroll: function () {
            $(window).scroll(function () {
                if ($(window).scrollTop() >= 5) {
                    $('.wrapper').addClass('fixed-header');
                }
                else {
                    $('.wrapper').removeClass('fixed-header');
                }
            });
        },

        mobileMenu: function () {
            $(".main-menu-toggle").on("click", function () {
                $("body").toggleClass("open-menu");
            });
        },

        mobileSubMenu: function () {
            $(".sub-menu-toggle").on("click", function () {
                $(this).parent("li").toggleClass("is-open");
            });
        },

        contactForm: function () {
            $("form[name='contact']").submit(function (e) {
                e.preventDefault();
                let url = $("form[name='contact']").attr('action');
                let formSerialize = $('form').serialize();
                let elResult = $('.result');

                $.post(url, formSerialize, function (response) {
                    elResult.empty();
                    $("input[name='contact[name]']").val('');
                    $("input[name='contact[email]']").val('');
                    $("input[name='contact[phone]']").val('');
                    $("input[name='contact[comment]']").val('');
                    location.replace(response);
                }, 'JSON').fail(function (response) {
                    elResult.empty();
                    elResult.append('<div class="alert">' + response.responseJSON + '</div>');
                });

                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset();
                }
            });
        },

        init: function () {
            this.modal();
            this.googleMap('map');
            this.mobileMenu();
            this.menuOverlay();
            this.headerScroll();
            this.mobileSubMenu();
            this.testimonialsSlider();
            this.contactForm();
        }
    };

    Frontend.init();
});
