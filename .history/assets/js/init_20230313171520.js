/*
= GET WINDOW WIDTH
------------------------------------------------------------------------------------- */

    function viewport() {
        var e = window,
            a = 'inner';
        if (!('innerWidth' in window)) {
            a = 'client';
            e = document.documentElement || document.body;
        };
        return { width: e[a + 'Width'] };
    };

/*
= MAIN CONTROLLER
-------------------------------------------------------------------------------------- */

    var momo = {
        windowW: 0,
        windowH: $(window).height(),
        html: $('html'),
        body: $('body'),
        device: null,
        distanceFromTop: 0,
        lastDistanceFromTop: 0,
        resizeTimeout: null,
        navOpened: false,
        imagesLoaded: false,
        videoFinished: false,
        header: $('header'),
        footer: $('footer'),
        init: function() {

        /*
        + Preloading */

            var animation = bodymovin.loadAnimation({
                container: document.getElementById('logo'),
                renderer: 'svg',
                loop: false,
                autoplay: true,
                path: themeUrl + '/assets/js/data.json'
            })
        
            animation.setSpeed(1.5);

            momo.body.preloading({
                beforeComplete: function() {
                },
                onComplete: function() {
                    $('body').addClass('anim-finished')
                }
            });

        /*
        + Detecting device */

            if (momo.html.hasClass('desktop')) { momo.device = 'desktop'; }
            else if (momo.html.hasClass('tablet')) { momo.device = 'tablet'; }
            else if (momo.html.hasClass('mobile')) { momo.device = 'mobile'; }

        /*
        + Choosing theme */

            momo.device == 'desktop' ?
                this.desktop.init() :
                this.handheld.init();

        },
        transformSetter: function(x, y, scale) {
            return {
                '-webkit-transform': 'translateX(' + x + ') translateY(' + y + ') translateZ(0px) rotate(0deg) scale(' + scale + ')',
                '-moz-transform': 'translateX(' + x + ') translateY(' + y + ') translateZ(0px) rotate(0deg) scale(' + scale + ')',
                'transform': 'translateX(' + x + ') translateY(' + y + ') translateZ(0px) rotate(0deg) scale(' + scale + ')',
            }
        },
        transitionSetter: function(property, duration, delay, easing) {
            return {
                '-webkit-transition': property + ' ' + duration + ' ' + delay + ' ' + easing,
                '-moz-transition': property + ' ' + duration + ' ' + delay + ' ' + easing,
                '-o-transition': property + ' ' + duration + ' ' + delay + ' ' + easing,
                '-ms-transition': property + ' ' + duration + ' ' + delay + ' ' + easing,
                'transition': property + ' ' + duration + ' ' + delay + ' ' + easing,
            }           
        },
        delaySetter: function(delay) {
            return {
                '-webkit-transition-delay': delay + 'ms',
                '-moz-transition-delay': delay + 'ms',
                '-ms-transition-delay': delay + 'ms',
                '-o-transition-delay': delay + 'ms',
                'transition-delay': delay + 'ms'
            }
        },      
        common: { 
            parallaxOffsets: [],
            animatedOffsets: [], 
            darkHeights: [],  
            texts: [],
            fixedOffsets: [],
            bodyH: 0,
            footerH: 0,
            logo: {
                top: 0,
                height: 0
            },
            parallaxPosition: function(element, index) {

                var currSpeed = element.data('speed'),
                    siteTopOffset = this.parallaxOffsets[index].top < momo.windowH ? momo.windowH - this.parallaxOffsets[index].top : 0,
                    currMovement = currSpeed * (this.parallaxOffsets[index].top - momo.lastDistanceFromTop - momo.windowH + siteTopOffset);
                currMovement += 0;
                if (((currSpeed < 0 && currMovement < 0) || (currSpeed > 0 && currMovement > 0))) currMovement = 0;
                element.css(momo.transformSetter('0px', currMovement + 'px', 1));

            }, 
            
            init: function() {
				
            /*
            + Prevent scrolling */

                window.addEventListener('scroll', function(e) {
                    if (momo.navOpened) {
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }
                }, {passive: false});
                window.addEventListener('mousewheel', function(e) {
                    if (momo.navOpened) {
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }
                }, {passive: false});
                window.addEventListener('touchmove', function(e) {
                    if (momo.navOpened) {
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }
                }, {passive: false});   

            /*
            + Call resize functionality */

                this.resize();

            /*
            + Scroll animations */

                var raf;

                if (typeof raf == 'undefined') scrollingAnimation();

                function scrollingAnimation() {

                    momo.distanceFromTop = $(window).scrollTop();

                    if (Math.abs(momo.lastDistanceFromTop - momo.distanceFromTop) >= 1) {

                        dY = momo.distanceFromTop - momo.lastDistanceFromTop;
                        momo.lastDistanceFromTop += (dY / 10); 


                    /*
                    + Parallax movement (if it's in view) */

                        $('.parallax').each(function(i) {
                            var curr = $(this);
                            if (momo.common.parallaxOffsets[i].top - momo.distanceFromTop  < momo.windowH &&
                                momo.distanceFromTop - (momo.common.parallaxOffsets[i].top + momo.common.parallaxOffsets[i].height) <= 0) {
                                momo.common.parallaxPosition(curr, i);
                            }
                        });

                    /*
                    + Animate element (if it's in view) */

                        $('.animated').each(function(i) {
                            var curr = $(this),
                                currOffset = momo.windowH;
                            if (momo.common.animatedOffsets[i].top - momo.distanceFromTop < currOffset)
                                curr.addClass('in-view');
                        });

                    /*
                    + Main navigation */
					if (momo.distanceFromTop > 0) {
						momo.distanceFromTop > momo.lastDistanceFromTop ?
							momo.body.addClass('going-down').removeClass('going-up') :
							momo.body.addClass('going-up').removeClass('going-down');
					}                    

                    }

                    raf = requestAnimationFrame(scrollingAnimation);

                };

            },
            resize: function() {

            /*
            + Setting animated elements' initial positions / offsets */

                this.parallaxOffsets = [];
                this.animatedOffsets = [];
                this.darkHeights = [];
                this.fixedOffsets = []

                $('.parallax, .animated').each(function(i) {
                    var curr = $(this),
                        currParam = {
                            top: curr.offset().top,
                            height: curr.outerHeight()
                        };
                    curr.hasClass('parallax') ?
                        momo.common.parallaxOffsets.push(currParam) :
                        momo.common.animatedOffsets.push(currParam);
                    if (curr.hasClass('animated')) {
                        if (curr.offset().top - momo.distanceFromTop < momo.windowH)
                            curr.addClass('in-view')
                    }
                });

                $('.parallax').each(function(i) {
                   momo.common.parallaxPosition($(this), i);
                });

                this.logo.top = $(window).width() <= 768 && (!momo.html.hasClass('desktop') && momo.html.hasClass('portrait')) ? 
                    parseInt(momo.header.children().css('padding-top')) :
                    parseInt(momo.header.children().css('padding-top')) + 1;
                this.logo.height = $('.logo .shape').height();


            },
        },   
        desktop: {
            init: function() {

            /*
            + Call common functionality */

                momo.common.init();

            /*
            + Call resize functionality */

                this.resize();

            },
            resize: function() {

            }
        },
        handheld: {
            init: function() {

            /*
            + Call common functionality */

                momo.common.init();

            /*
            + Call resize functionality */

                this.resize();

            /*
            + Scrolling animation */

                var raf;

                if (typeof raf == 'undefined') scrollingAnimation();

                function scrollingAnimation() {

                    raf = requestAnimationFrame(scrollingAnimation);

                };

            },
            resize: function() {

            }
        },
        resize: function() {

            if (this.device == 'desktop' || this.windowW != $(window).width()) {

                if (this.resizeTimeout != null) {
                    clearTimeout(this.resizeTimeout)
                    this.resizeTimeout = null;
                }

                this.resizeTimeout = setTimeout(function() {

                    momo.windowW = $(window).width();
                    momo.windowH = $(window).height();

                    momo.common.resize();

                    momo.device == 'desktop' ?
                        momo.desktop.resize() :
                        momo.handheld.resize();

                    clearTimeout(momo.resizeTimeout)
                    momo.resizeTimeout = null;

                }, 500)

            }

        }
    }

    $(window).resize(function() {
        momo.resize();
    })    

    momo.init();

    momo.resize();
	
	
    
$(document).ready(function(){
    
	
	$(window).scroll(function() {    
		var scroll = $(window).scrollTop();

		if (scroll <= 150) {
			$('body').addClass('header-in-view');
		} else {
			$('body').removeClass('header-in-view');
		}
	});
	
	
});

