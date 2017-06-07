// home page slider
;(function($){
    $(function(){
        if ($('body').hasClass('home') || $('body').hasClass('page-template-home-static')) {
            var calculateSliderHeight = function() {
                var screenHeight = $(window).height();
                var squarHeight = $('.slider .square').height();
                var squareOffset = screenHeight/2 - squarHeight/2;
                $('.slider').css('height', screenHeight+'px');
                $('.slider > .container').css('padding-top', squareOffset+'px');
            }
            calculateSliderHeight();

            $(window).on('resize', function(event){
                calculateSliderHeight();
            });
            
            var sliderEl =  $('.slider .slide-item');
            var sliderCount = sliderEl.length;
            var sliderWrapper = $('.slider-wrapper');
            var prevBtn = $('#prev-slide');
            var nextBtn = $('#next-slide');
            var i = j = 1;

            sliderEl.each(function(index, el){
                $(el).css({'transform': 'translateX('+(100*index)+'%)'});
            });

            nextBtn.on('click', function(){ 
                if (i >= sliderCount) {
                    i = 0;
                }
                if (i < 0) {
                    i = 1;
                }
                sliderWrapper.css({'transform': 'translateX(-'+(100*i)+'%)'});
                i++;
            });

            prevBtn.on('click', function(){
                if (i >= sliderCount) {
                    i = 0;
                }
                if (i < 0) {
                    i = sliderCount-1;
                }
                if (j == 1) {
                    i = sliderCount-1;
                    j++;
                }
                sliderWrapper.css({'transform': 'translateX(-'+(100*i)+'%)'});
                i--;
            });
        }
    });
})(jQuery);

// home page scroll effect
;(function($){
    $(function(){
        if ($('body').hasClass('home')) {
            $(document).on('scroll', function(event){
                if ($(this).scrollTop() > 0) {
                    $('.header').addClass('header-color');
                } else {
                    $('.header').removeClass('header-color'); 
                }
            });         
        }
    });
})(jQuery);

// Search modal
;(function($){
    $(function(){
        $('#search-modal-button').on('click', function(){
            $('#search-modal-form').toggleClass('active');
            return false;
        });
    });
})(jQuery);

//scroll btns
;(function($){
    $(function(){
        var scrollBtns = $('.scroll-btn');
        if (scrollBtns.length > 0) {
            var htmlBodyEl = $("html, body");
            scrollBtns.on('click', function(evente){
                var hrefData = $(this).attr('href'),
                    targetElOffset = $(hrefData).offset().top,
                    headerHeight = $('.header-offset').height(),
                    scrollPosition = targetElOffset - headerHeight - 100;

                htmlBodyEl.animate({ scrollTop: scrollPosition }, 500);
                return false;
            });
        } 
    });
})(jQuery);

// Services scroll effect
;(function($){
    $(function(){
        if ($('body').hasClass('services') || $('body').hasClass('page-template-services')) {
            var animateServicesScroll = function() {
                if ($(window).width() >= 975 && $(window).width() < 1200) {
                    $('.deep-foundation .presentation .image-wrapper').css({
                        'transform': 'translate3d(-50px, -120px, 0) scale(0.7)'
                    });
                }
                if ($(window).width() >= 975) {
                    var containerHeight = 1300,
                        step = 30;

                    $('.deep-foundation .presentation').css('height', containerHeight+'px');
                    $('.deep-foundation .presentation-1 .image-wrapper').css({'position': 'fixed'});

                     $(document).on('scroll', function(event) {
                        var topScroll = $(this).scrollTop(),
                            imgHeight = $('.deep-foundation .presentation-1 .image-wrapper').height(),
                            topOffset = $('.deep-foundation .presentation-1').offset().top,
                            topCail = Math.ceil(topOffset);

                        //presentation-1
                        if (topScroll < imgHeight) {
                            $('.deep-foundation .presentation-1 .image-wrapper').css({
                                'position': 'fixed'
                            });
                            $('.deep-foundation .presentation-1 .image-color').css('height', imgHeight-topScroll-step+'px');
                            $('.deep-foundation .presentation-1 .image-lines').css({
                                'bottom': 0,
                                'top': '',
                                'background-position': 'center bottom',
                                'height': topScroll+step+'px'
                            })
                        }
                        if (topScroll < step/3) {
                            $('.deep-foundation .presentation-1 .image-lines').css({
                                'height': '0'
                            })
                        }
                        if (topScroll > imgHeight) {
                            $('.deep-foundation .presentation-1 .image-lines').css({
                                'top': 0,
                                'background-position': 'center top',
                                'height': imgHeight*2 - topScroll+'px'
                            });
                        }
                        //presentation-2
                        if (topScroll > containerHeight) {
                            $('.deep-foundation .presentation-1 .image-color').css('height', '0px');
                            $('.deep-foundation .presentation-2 .image-wrapper').css({
                                'position': 'fixed',
                                'top': topCail+'px'
                            });
                            $('.deep-foundation .presentation-2 .image-color').css('height', containerHeight+imgHeight-topScroll-step+'px');
                            $('.deep-foundation .presentation-2 .image-lines').css({
                                'bottom': 0,
                                'top': '',
                                'background-position': 'center bottom',
                                'height': topScroll-containerHeight+step+'px'
                            })
                        }
                        if (topScroll > containerHeight+imgHeight) {
                            $('.deep-foundation .presentation-2 .image-lines').css({
                                'top': 0,
                                'bottom': '',
                                'background-position': 'center top',
                                'height': containerHeight+imgHeight*2 - topScroll+'px'
                            });
                        }
                        if (topScroll < containerHeight) {
                             $('.deep-foundation .presentation-2 .image-wrapper').css({
                                'position': 'relative',
                                'top': '0'
                            });
                        }
                        //presentation-3
                        if (topScroll > 2*containerHeight) {
                            $('.deep-foundation .presentation-2 .image-color').css('height', '0px');
                            $('.deep-foundation .presentation-3 .image-wrapper').css({
                                'position': 'fixed',
                                'top': topCail+'px'
                            });
                            $('.deep-foundation .presentation-3 .image-color').css('height', 2*containerHeight+imgHeight-topScroll-step+'px');
                            $('.deep-foundation .presentation-3 .image-lines').css({
                                'bottom': 0,
                                'top': '',
                                'background-position': 'center bottom',
                                'height': topScroll-2*containerHeight+step+'px'
                            })
                        }
                        if (topScroll > 2*containerHeight+imgHeight) {
                            $('.deep-foundation .presentation-3 .image-lines').css({
                                'top': 0,
                                'bottom': '',
                                'background-position': 'center top',
                                'height': 2*containerHeight+imgHeight*2 - topScroll+'px'
                            });
                        }
                        if (topScroll < 2*containerHeight) {
                            $('.deep-foundation .presentation-3 .image-wrapper').css({
                                'position': 'relative',
                                'top': '0'
                            });
                        }
                    });
                }
            };

            animateServicesScroll();

            $(window).on('resize', function(event){
                animateServicesScroll();
            });
        }
    });
})(jQuery);

// Accordion functional
;(function($) {
    $(function() {
        $('.accordion-list .title').on('click', function(event) {
            $(this).parent().toggleClass('active');
        });
    });
})(jQuery);

// Projects auto height functional 
;(function($){
    $(function(){
        var screenHeight = $(window).height();
        $('.map-projects #map-canvas').height(screenHeight);
    });
})(jQuery);

// google maps functional
;(function($){
    $(function() {
        if (typeof(google) !== 'undefined') {
            var iconImg = 'images/map-marker.png';

            var iconSvg = {
                path: 'M8.2,1.7c-3.7,0-6.7,3-6.7,6.7 c0,1.2,0.3,2.3,0.9,3.3l5.8,8.6l5.8-8.6c0.6-1,0.9-2.1,0.9-3.3C14.9,4.7,11.9,1.7,8.2,1.7z M8.2,10.6C7,10.6,6,9.6,6,8.4 c0-1.2,1-2.2,2.2-2.2c1.2,0,2.2,1,2.2,2.2C10.4,9.6,9.4,10.6,8.2,10.6z',
                strokeColor: '#F05023',
                strokeOpacity: 1,
                strokeWeight: 1.5,
                fillOpacity: 0,
                rotation: 0,
                scale: 1.0
            };

            var markers = [];

            var markerOne = new google.maps.LatLng(19.903943, -155.248656);
            var markerTwo = new google.maps.LatLng(40.084965, -122.202501);

            var projectsMapCenter = new google.maps.LatLng(46.986399, -142.856798);
            var contactMapCenter = new google.maps.LatLng(40.084965, -122.202501);
			var contactOakland = new google.maps.LatLng(37.7430368,-122.2030777);
			var contactLA = new google.maps.LatLng(34.0663374,-117.5852478);
			var contactPortland = new google.maps.LatLng(45.5324677,-122.571612);
			var contactSanDiego = new google.maps.LatLng(32.8977784,-117.1198396);
			var contactSeatle = new google.maps.LatLng(47.416101,-122.224257);
			

            var stylesMap = [
                {
                    featureType: "all",
                    stylers: [
                        {saturation: -80}
                    ]
                }, {
                    featureType: "landscape",
                    elementType: "all",
                    stylers: [
                        {color: "#f5f5f5"}
                    ]
                }, {
                    featureType: "road.highway",
                    elementType: "geometry",
                    stylers: [
                        {visibility: "on"},
                        {hue: "#ff0000"}
                    ]
                }, {
                    featureType: "water",
                    elementType: "geometry",
                    stylers: [
                        {visibility: "on"},
                        {hue: "#98a39c"},
                        {lightness: -27},
                        {saturation: -70}
                    ]
                }, {
                    featureType: "water",
                    elementType: "labels.text",
                    stylers: [
                        {color: "#616b6c"}
                    ]
                }
            ];

            if (document.getElementById("map-canvas") !== null) {
                var projectsMapOptions = {
                    zoom: 6,
                    center: projectsMapCenter,
                    scrollwheel: false,
                    mapTypeId: 'roadmap',
                    styles: stylesMap
                };

                window.projectsMap = new google.maps.Map(document.getElementById("map-canvas"), projectsMapOptions);

              /*  var projectsMarkerOne = new google.maps.Marker({
                    position: markerOne,
                    map: projectsMap,
                    icon: iconSvg
                });

                var projectsMarkerTwo = new google.maps.Marker({
                    position: markerTwo,
                    map: projectsMap,
                    icon: iconSvg
                });

                var infoMarkerOne = new google.maps.InfoWindow({
                    content: "Some text to marker"
                });
                var infoMarkerTwo = new google.maps.InfoWindow({
                    content: "Some text to marker"
                });*/

               /* google.maps.event.addListener(projectsMarkerOne, 'click', function () {
                    infoMarkerOne.open(projectsMap, projectsMarkerOne)
                });
                google.maps.event.addListener(projectsMarkerTwo, 'click', function () {
                    infoMarkerTwo.open(projectsMap, projectsMarkerTwo)
                });*/

                $('#deep-foundation').on('click', function (event) {
                    projectsMap.setCenter(markerOne);
                });

                $('#earth-retention').on('click', function (event) {
                    projectsMap.setCenter(markerTwo);
                });

            } else if (document.getElementById("contact-map-canvas") !== null) {
                var contactMapOptions = {
                    zoom: 2,
                    center: contactMapCenter,
                    scrollwheel: false,
                    mapTypeId: 'roadmap',
                    styles: stylesMap,
                    draggable: ($(document).width() > 600)
                };

                var contactMap = new google.maps.Map(document.getElementById("contact-map-canvas"), contactMapOptions);

                var contactMarkerOne = new google.maps.Marker({
                    position: contactOakland,
                    map: contactMap,
                    icon: iconSvg,
					title:"Oakland",
					animation: google.maps.Animation.DROP
                });
				
                var contactMarkerTwo = new google.maps.Marker({
                    position: contactLA,
                    map: contactMap,
                    icon: iconSvg,
					title:"Los Angeles",
					animation: google.maps.Animation.DROP
                });
				
                var contactMarkerThree = new google.maps.Marker({
                    position: contactPortland,
                    map: contactMap,
                    icon: iconSvg,
					title:"Portland",
					animation: google.maps.Animation.DROP
                });
				
                var contactMarkerFour = new google.maps.Marker({
                    position: contactSanDiego,
                    map: contactMap,
                    icon: iconSvg,
					title:"San Diego",
					animation: google.maps.Animation.DROP
                });
				
                var contactMarkerFive = new google.maps.Marker({
                    position: contactSeatle,
                    map: contactMap,
                    icon: iconSvg,
					title:"Seatle",
					animation: google.maps.Animation.DROP
                });
            }
        }
    });
})(jQuery);

// Careers page scroll functional
;(function($){
    $(function(){
        if ($('body').hasClass('careers') || $('body').hasClass('page-template-careers')) {
            var scrollBrn = $('#scroll-to-careers-list'),
                careersListOffsetTop = $('#careers-list').offset().top,
                headerHeight = $('.header').height(),
                scrollToCareers = Math.ceil(careersListOffsetTop) - headerHeight;

            scrollBrn.on('click', function(){
                $("html, body").animate({scrollTop: scrollToCareers}, 600);
                return false;
            });
        }
    });
})(jQuery);
