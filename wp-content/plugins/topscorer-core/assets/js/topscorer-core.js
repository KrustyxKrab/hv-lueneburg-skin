(function ($) {
    "use strict";

    window.qodefCore = {};
    qodefCore.shortcodes = {};

    $(document).ready(function () {
        qodefInlinePageStyle.init();
    });

    var qodefScroll = {
        disable: function () {
            if (window.addEventListener) {
                window.addEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
            }

            // window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
            document.onkeydown = qodefScroll.keyDown;
        },
        enable: function () {
            if (window.removeEventListener) {
                window.removeEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
            }
            window.onmousewheel = document.onmousewheel = document.onkeydown = null;
        },
        preventDefaultValue: function (e) {
            e = e || window.event;
            if (e.preventDefault) {
                e.preventDefault();
            }
            e.returnValue = false;
        },
        keyDown: function (e) {
            var keys = [37, 38, 39, 40];
            for (var i = keys.length; i--;) {
                if (e.keyCode === keys[i]) {
                    qodefScroll.preventDefaultValue(e);
                    return;
                }
            }
        }
    };

    qodefCore.qodefScroll = qodefScroll;

    var qodefPerfectScrollbar = {
        init: function (holder) {
            if (holder.length) {
                qodefPerfectScrollbar.qodefInitScroll(holder);
            }
        },
        qodefInitScroll: function (holder) {
            var $defaultParams = {
                wheelSpeed: 0.6,
                suppressScrollX: true
            };

            var ps = new PerfectScrollbar(holder[0], $defaultParams);
            $(window).resize(function () {
                ps.update();
            });
        }
    };

    qodefCore.qodefPerfectScrollbar = qodefPerfectScrollbar;

    var qodefInlinePageStyle = {
        init: function () {
            this.holder = $('#topscorer-core-page-inline-style');

            if (this.holder.length) {
                var style = this.holder.data('style');

                if (style.length) {
                    $('head').append('<style type="text/css">' + style + '</style>');
                }
            }
        }
    };

})(jQuery);
(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefBackToTop.init();
		}
	);

	var qodefBackToTop = {
		init: function () {
			this.holder = $( '#qodef-back-to-top' );

			if ( this.holder.length ) {
				// Scroll To Top
				this.holder.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefBackToTop.animateScrollToTop();
					}
				);

				qodefBackToTop.showHideBackToTop();
			}
		},
		animateScrollToTop: function () {
			window.scrollTo( { top: 0, behavior: 'smooth' } );
		},
		showHideBackToTop: function () {
			$( window ).scroll(
				function () {
					var $thisItem = $( this ),
						b         = $thisItem.scrollTop(),
						c         = $thisItem.height(),
						d;

					if ( b > 0 ) {
						d = b + c / 2;
					} else {
						d = 1;
					}

					if ( d < 1e3 ) {
						qodefBackToTop.addClass( 'off' );
					} else {
						qodefBackToTop.addClass( 'on' );
					}
				}
			);
		},
		addClass: function ( a ) {
			this.holder.removeClass( 'qodef--off qodef--on' );

			if ( a === 'on' ) {
				this.holder.addClass( 'qodef--on' );
			} else {
				this.holder.addClass( 'qodef--off' );
			}
		}
	};

})( jQuery );

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefFullscreenMenu.init();
	});
	
	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $('a.qodef-fullscreen-menu-opener'),
				$menuItems = $('.qodef-fullscreen-menu-holder nav ul li a');
			
			// Open popup menu
			$fullscreenMenuOpener.on('click', function (e) {
				e.preventDefault();
				
				if (!qodef.body.hasClass('qodef-fullscreen-menu--opened')) {
					qodefFullscreenMenu.openFullscreen();
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefFullscreenMenu.closeFullscreen();
						}
					});
				} else {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
			
			//open dropdowns
			$menuItems.on('tap click', function (e) {
				var $thisItem = $(this);
				if ($thisItem.parent().hasClass('menu-item-has-children')) {
					e.preventDefault();
					qodefFullscreenMenu.clickItemWithChild($thisItem);
				} else if (($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")) {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
		},
		openFullscreen: function () {
			qodef.body.removeClass('qodef-fullscreen-menu-animate--out').addClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in');
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function () {
			qodef.body.removeClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in').addClass('qodef-fullscreen-menu-animate--out');
			qodefCore.qodefScroll.enable();
			$("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200);
		},
		clickItemWithChild: function (thisItem) {
			var $thisItemParent = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find('.sub-menu').first();
			
			if ($thisItemSubMenu.is(':visible')) {
				$thisItemSubMenu.slideUp(300);
			} else {
				$thisItemSubMenu.slideDown(300);
				$thisItemParent.siblings().find('.sub-menu').slideUp(400);
			}
		}
	};
	
})(jQuery);
(function($){
    "use strict";

    $(document).ready(function () {
        qodefHeaderScrollAppearance.init();
    });

    var qodefHeaderScrollAppearance = {
        appearanceType: function(){
            return qodef.body.attr('class').indexOf('qodef-header-appearance--') !== -1 ? qodef.body.attr('class').match(/qodef-header-appearance--([\w]+)/)[1] : '';
        },
        init: function(){
            var appearanceType = this.appearanceType();

            if(appearanceType !== '' && appearanceType !== 'none'){
                window.qodef[appearanceType+"HeaderAppearance"]();
            }
        }
    };

})(jQuery);

(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefMobileHeaderAppearance.init();
    });

    /*
     **	Init mobile header functionality
     */
    var qodefMobileHeaderAppearance = {
        init: function () {
            if (qodef.body.hasClass('qodef-mobile-header-appearance--sticky')) {

                var docYScroll1 = qodef.scroll,
                    displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
                    $pageOuter = $('#qodef-page-outer');

                qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                $(window).scroll(function () {
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                    docYScroll1 = qodef.scroll;
                });

                $(window).resize(function () {
                    $pageOuter.css('padding-top', 0);
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                });
            }
        },
        showHideMobileHeader: function(docYScroll1, displayAmount,$pageOuter){
            if(qodef.windowWidth <= 1024) {
                if (qodef.scroll > displayAmount * 2) {
                    //set header to be fixed
                    qodef.body.addClass('qodef-mobile-header--sticky');

                    //add transition to it
                    setTimeout(function () {
                        qodef.body.addClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //add padding to content so there is no 'jumping'
                    $pageOuter.css('padding-top', qodefGlobal.vars.mobileHeaderHeight);
                } else {
                    //unset fixed header
                    qodef.body.removeClass('qodef-mobile-header--sticky');

                    //remove transition
                    setTimeout(function () {
                        qodef.body.removeClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //remove padding from content since header is not fixed anymore
                    $pageOuter.css('padding-top', 0);
                }

                if ((qodef.scroll > docYScroll1 && qodef.scroll > displayAmount) || (qodef.scroll < displayAmount * 3)) {
                    //show sticky header
                    qodef.body.removeClass('qodef-mobile-header--sticky-display');
                } else {
                    //hide sticky header
                    qodef.body.addClass('qodef-mobile-header--sticky-display');
                }
            }
        }
    };

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefNavMenu.init();
		qodefNavMenu.wideDropdownPosition();
		qodefNavMenu.dropdownPosition();
	});
	
	var qodefNavMenu = {
		wideDropdownPosition: function () {
			var $menuItems = $(".qodef-header-navigation > ul > li.qodef-menu-item--wide");
			
			if ($menuItems.length) {
				$menuItems.each(function () {
					var $menuItem = $(this);
					var $menuItemSubMenu = $menuItem.find('.qodef-drop-down-second');
					
					if ($menuItemSubMenu.length) {
						$menuItemSubMenu.css('left', 0);
						
						var leftPosition = $menuItemSubMenu.offset().left;
						
						if (qodef.body.hasClass('qodef--boxed')) {
							//boxed layout case
							var boxedWidth = $('.qodef--boxed .qodef-wrapper .qodef-wrapper-inner').outerWidth();
							leftPosition = leftPosition - (qodef.windowWidth - boxedWidth) / 2;
							$menuItemSubMenu.css({'left': -leftPosition, 'width': boxedWidth});
							
						} else if (qodef.body.hasClass('qodef-drop-down-second--full-width')) {
							//wide dropdown full width case
							$menuItemSubMenu.css({'left': -leftPosition});
						}
						else {
							//wide dropdown in grid case
							$menuItemSubMenu.css({'left': -leftPosition + (qodef.windowWidth - $menuItemSubMenu.width()) / 2});
						}
					}
				});
			}
		},
		dropdownPosition: function () {
			var $menuItems = $('.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children');
			
			if ($menuItems.length) {
				$menuItems.each(function () {
					var $thisItem = $(this),
						menuItemPosition = $thisItem.offset().left,
						$dropdownHolder = $thisItem.find('.qodef-drop-down-second'),
						$dropdownMenuItem = $dropdownHolder.find('.qodef-drop-down-second-inner ul'),
						dropdownMenuWidth = $dropdownMenuItem.outerWidth(),
						menuItemFromLeft = $(window).width() - menuItemPosition;
					
					var dropDownMenuFromLeft;
					
					if ($thisItem.find('li.menu-item-has-children').length > 0) {
						dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
					}
					
					$dropdownHolder.removeClass('qodef-drop-down--right');
					$dropdownMenuItem.removeClass('qodef-drop-down--right');
					if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
						$dropdownHolder.addClass('qodef-drop-down--right');
						$dropdownMenuItem.addClass('qodef-drop-down--right');
					}
				});
			}
		},
		init: function () {
			var $menuItems = $('.qodef-header-navigation > ul > li');
			
			$menuItems.each(function () {
				var $thisItem = $(this);
				
				if ($thisItem.find('.qodef-drop-down-second').length) {
					$thisItem.waitForImages(function () {
						var $dropDownHolder = $thisItem.find('.qodef-drop-down-second'),
							$dropdownMenuItem = $dropDownHolder.find('.qodef-drop-down-second-inner ul'),
							dropDownHolderHeight = $dropdownMenuItem.outerHeight();
						
						if (!qodef.menuDropdownHeightSet) {
							$dropDownHolder.height(0);
						}
						
						if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
							$thisItem.on("touchstart mouseenter", function () {
								$dropDownHolder.css({
									'height': dropDownHolderHeight,
									'overflow': 'visible',
									'visibility': 'visible',
									'opacity': '1'
								});
							}).on("mouseleave", function () {
								$dropDownHolder.css({
									'height': '0px',
									'overflow': 'hidden',
									'visibility': 'hidden',
									'opacity': '0'
								});
							});
						} else {
							if ($('body').hasClass('qodef-drop-down-second--animate-height')) {
								var animateConfig = {
									interval: 0,
									over: function () {
										setTimeout(function () {
											$dropDownHolder.addClass('qodef-drop-down--start').css({
												'visibility': 'visible',
												'height': '0',
												'opacity': '1'
											});
											$dropDownHolder.stop().animate({
												'height': dropDownHolderHeight
											}, 400, 'easeInOutQuint', function () {
												$dropDownHolder.css('overflow', 'visible');
											});
										}, 100);
									},
									timeout: 100,
									out: function () {
										$dropDownHolder.stop().animate({
											'height': '0',
											'opacity': 0
										}, 100, function () {
											$dropDownHolder.css({
												'overflow': 'hidden',
												'visibility': 'hidden'
											});
										});
										
										$dropDownHolder.removeClass('qodef-drop-down--start');
									}
								};
								
								$thisItem.hoverIntent(animateConfig);
							} else {
								var config = {
									interval: 0,
									over: function () {
										setTimeout(function () {
											$dropDownHolder.addClass('qodef-drop-down--start').stop().css({'height': dropDownHolderHeight});
										}, 150);
									},
									timeout: 150,
									out: function () {
										$dropDownHolder.stop().css({'height': '0'}).removeClass('qodef-drop-down--start');
									}
								};
								$thisItem.hoverIntent(config);
							}
						}
					});
				}
			});
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";

    $(window).on('load', function () {
		qodefParallaxBackground.init();
	});

	/**
	 * Init global parallax background functionality
	 */
	var qodefParallaxBackground = {
		init: function (settings) {
			this.$sections = $('.qodef-parallax');

			// Allow overriding the default config
			$.extend(this.$sections, settings);

			var isSupported = !qodef.html.hasClass('touchevents') && !qodef.body.hasClass('qodef-browser--edge') && !qodef.body.hasClass('qodef-browser--ms-explorer');

			if (this.$sections.length && isSupported) {
				this.$sections.each(function () {
					qodefParallaxBackground.ready($(this));
				});
			}
		},
		ready: function ($section) {
			$section.$imgWrapper = $section.find('.qodef-parallax-img-wrapper');
			$section.$img = $section.find('img');

			var h = $section.height(),
				imgWrapperH = $section.$imgWrapper.height();

			$section.movement = 100 * (imgWrapperH - h) / h / 2; //percentage (divided by 2 due to absolute img centering in CSS)

			$section.buffer = window.pageYOffset;
			$section.scrollBuffer = null;

			//calc and init loop
			requestAnimationFrame(function () {
				qodefParallaxBackground.calc($section);
				qodefParallaxBackground.loop($section);
			});

			//recalc
			$(window).on('resize', function () {
				qodefParallaxBackground.calc($section);
			});
		},
		calc: function ($section) {
			var wH = $section.$imgWrapper.height(),
				wW = $section.$imgWrapper.width();

			if ($section.$img.width() < wW) {
				$section.$img.css({
					'width': '100%',
					'height': 'auto'
				});
			}

			if ($section.$img.height() < wH) {
				$section.$img.css({
					'height': '100%',
					'width': 'auto'
				});
			}
		},
		loop: function ($section) {
			if ($section.scrollBuffer === Math.round(window.pageYOffset)) {
				requestAnimationFrame(function () {
					qodefParallaxBackground.loop($section);
				}); //repeat loop
				return false; //same scroll value, do nothing
			} else {
				$section.scrollBuffer = Math.round(window.pageYOffset);
			}

			var wH = window.outerHeight,
				sTop = $section.offset().top,
				sH = $section.height();
			
			if ($section.scrollBuffer + wH * 1.2 > sTop && $section.scrollBuffer < sTop + sH) {
				var delta = (Math.abs($section.scrollBuffer + wH - sTop) / (wH + sH)).toFixed(4), //coeff between 0 and 1 based on scroll amount
					yVal = (delta * $section.movement).toFixed(4);
				
				if ($section.buffer !== delta) {
					$section.$imgWrapper.css('transform', 'translate3d(0,' + yVal + '%, 0)');
				}
				
				$section.buffer = delta;
			}

			requestAnimationFrame(function () {
				qodefParallaxBackground.loop($section);
			}); //repeat loop
		}
	};

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSideArea.init();
	});
	
	var qodefSideArea = {
		init: function () {
			var $sideAreaOpener = $('a.qodef-side-area-opener'),
				$sideAreaClose = $('#qodef-side-area-close'),
				$sideArea = $('#qodef-side-area');
				
				qodefSideArea.openerHoverColor($sideAreaOpener);
			// Open Side Area
			$sideAreaOpener.on('click', function (e) {
				e.preventDefault();
				
				if (!qodef.body.hasClass('qodef-side-area--opened')) {
					qodefSideArea.openSideArea();
					
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefSideArea.closeSideArea();
						}
					});
				} else {
					qodefSideArea.closeSideArea();
				}
			});
			
			$sideAreaClose.on('click', function (e) {
				e.preventDefault();
				qodefSideArea.closeSideArea();
			});
			
			if ($sideArea.length && typeof window.qodefCore.qodefPerfectScrollbar === 'object') {
				window.qodefCore.qodefPerfectScrollbar.init($sideArea);
			}
		},
		openSideArea: function () {
			var $wrapper = $('#qodef-page-wrapper');
			var currentScroll = $(window).scrollTop();

			$('.qodef-side-area-cover').remove();
			$wrapper.prepend('<div class="qodef-side-area-cover"/>');
			/*qodef.body.removeClass('qodef-side-area-animate--out').addClass('qodef-side-area--opened qodef-side-area-animate--in');*/
			qodef.body.removeClass('qodef-side-area-animate--out').addClass('qodef-side-area-animate--in') ;
			setTimeout(function () {
				qodef.body.addClass('qodef-side-area--opened');
			}, 10);

			$('.qodef-side-area-cover').on('click', function (e) {
				e.preventDefault();
				qodefSideArea.closeSideArea();
			});

			$(window).scroll(function () {
				if (Math.abs(qodef.scroll - currentScroll) > 400) {
					qodefSideArea.closeSideArea();
				}
			});

		},
		closeSideArea: function () {
			qodef.body.removeClass('qodef-side-area--opened qodef-side-area-animate--in').addClass('qodef-side-area-animate--out');
		},
		openerHoverColor: function ($opener) {
			if (typeof $opener.data('hover-color') !== 'undefined') {
				var hoverColor = $opener.data('hover-color');
				var originalColor = $opener.css('color');
				
				$opener.on('mouseenter', function () {
					$opener.css('color', hoverColor);
				}).on('mouseleave', function () {
					$opener.css('color', originalColor);
				});
			}
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSpinner.init();
	});
	
	var qodefSpinner = {
		init: function () {
			this.holder = $('#qodef-page-spinner:not(.qodef--custom-spinner)');
			
			if (this.holder.length) {
				if (!this.holder.hasClass('qodef-layout--predefined')) {
					qodefSpinner.animateSpinner(this.holder);
				} else {
					qodefSpinner.animateCustomSpinner(this.holder);
				}
				qodefSpinner.animateSpinner(this.holder);
				qodefSpinner.fadeOutAnimation();
			}
		},
		animateSpinner: function ($holder) {
			$(window).on('load', function () {
				qodefSpinner.fadeOutLoader($holder);
			});
			
			if (window.elementorFrontend) {
				qodefSpinner.fadeOutLoader($holder);
			}
		},
		animateCustomSpinner: function ($holder) {
			var preloaderText = this.holder.find('.qodef-predefined-spinner-text'),
				preloaderCharacter = preloaderText.find('.qodef-e-character'),
				qodefSpinnerInterval,
				mainRevHolder = $('#qodef-main-rev-holder rs-module');
			
			if( preloaderText.length ) {
				setTimeout(function () {
					var qodefAnimatePredefinedSpinner = function () {
						preloaderCharacter.each(function (index) {
							preloaderCharacter.eq(index).css({
								'opacity': '1',
								'transform': 'rotateX(0) rotateY(0)',
								'transition-delay': .1 + 0.08 * index + 's'
							});
						});
						
						setTimeout(function() {
							preloaderCharacter.each(function ( index ) {
								preloaderCharacter.eq(index).css({
									'opacity': '0',
									'transform': 'perspective(750px) rotateX(90deg)',
									'transition-duration': '.4s'
								});
							});
						}, 1500);
					};
					
					preloaderText.css({'opacity': '1'});
					qodefAnimatePredefinedSpinner();
					qodefSpinnerInterval = setInterval(function(){
						qodefAnimatePredefinedSpinner();
					}, 3000);
				}, 300);
				
				$(window).on('load', function() {
					qodefSpinner.fadeOutLoader($holder, 900, 3600);
					
					setTimeout(function () {
						clearInterval(qodefSpinnerInterval);
					}, 3300);
					
					if(mainRevHolder.length) {
						setTimeout(function() {
							mainRevHolder.revstart();
						}, 3700);
					}
				});
			}
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';
			
			$holder.delay(delay).fadeOut(speed, easing);
			
			$(window).on('bind', 'pageshow', function (event) {
				if (event.originalEvent.persisted) {
					$holder.fadeOut(speed, easing);
				}
			});
		},
		fadeOutAnimation: function () {
			
			// Check for fade out animation
			if ($('body').hasClass('qodef-spinner--fade-out')) {
				var $pageHolder = $('#qodef-page-wrapper'),
					$linkItems = $('a');
				
				// If back button is pressed, than show content to avoid state where content is on display:none
				window.addEventListener("pageshow", function (event) {
					var historyPath = event.persisted || (typeof window.performance !== "undefined" && window.performance.navigation.type === 2);
					if (historyPath && !$pageHolder.is(':visible')) {
						$pageHolder.show();
					}
				});
				
				$linkItems.on('click', function (e) {
					var $clickedLink = $(this);
					
					if (
						e.which === 1 && // check if the left mouse button has been pressed
						$clickedLink.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
						!$clickedLink.hasClass('remove') && // check is WooCommerce remove link
						$clickedLink.parent('.product-remove').length <= 0 && // check is WooCommerce remove link
						$clickedLink.parents('.woocommerce-product-gallery__image').length <= 0 && // check is product gallery link
						typeof $clickedLink.data('rel') === 'undefined' && // check pretty photo link
						typeof $clickedLink.attr('rel') === 'undefined' && // check VC pretty photo link
						!$clickedLink.hasClass('lightbox-active') && // check is lightbox plugin active
						(typeof $clickedLink.attr('target') === 'undefined' || $clickedLink.attr('target') === '_self') && // check if the link opens in the same window
						$clickedLink.attr('href').split('#')[0] !== window.location.href.split('#')[0] // check if it is an anchor aiming for a different page
					) {
						e.preventDefault();
						
						$pageHolder.fadeOut(600, 'easeOutSine', function () {
							window.location = $clickedLink.attr('href');
						});
					}
				});
			}
		}
	}
	
})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefSportsPressSelect2.init();
    });

    var qodefSportsPressSelect2 = {
        init: function (settings) {
            this.holder = [];
            this.holder.push({
                holder: $('.qodef-sportspress .sp-profile-selector'),
                options: {minimumResultsForSearch: Infinity}
            });

            // allow overriding the default config
            $.extend(this.holder, settings);

            if (typeof this.holder === 'object') {
                $.each(this.holder, function (key, value) {
                    qodefSportsPressSelect2.createSelect2(value.holder, value.options);
                });
            }
        },

        createSelect2: function ($holder, options) {
            if (typeof $holder.select2 === 'function') {
                $holder.select2(options);
            }
        }
    };

})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefAccordion.init();
	});
	
	var qodefAccordion = {
		init: function () {
			this.holder = $('.qodef-accordion');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					
					if ($thisHolder.hasClass('qodef-behavior--accordion')) {
						qodefAccordion.initAccordion($thisHolder);
					}
					
					if ($thisHolder.hasClass('qodef-behavior--toggle')) {
						qodefAccordion.initToggle($thisHolder);
					}
					
					$thisHolder.addClass('qodef--init');
				});
			}
		},
		initAccordion: function (accordion) {
			accordion.accordion({
				animate: "swing",
				collapsible: true,
				active: 0,
				icons: "",
				heightStyle: "content"
			});
		},
		initToggle: function (toggle) {
			var $toggleAccordionTitle = toggle.find('.qodef-accordion-title'),
				$toggleAccordionContent = $toggleAccordionTitle.next();
			
			toggle.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
			$toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
			$toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();
			
			$toggleAccordionTitle.each(function () {
				var $thisTitle = $(this);
				
				$thisTitle.hover(function () {
					$thisTitle.toggleClass("ui-state-hover");
				});
				
				$thisTitle.on('click', function () {
					$thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
					$thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
				});
			});
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefButton.init();
	});
	
	var qodefButton = {
		init: function () {
			this.buttons = $('.qodef-button');
			
			if (this.buttons.length) {
				this.buttons.each(function () {
					var $thisButton = $(this);
					
					qodefButton.buttonHoverColor($thisButton);
				});
			}
		},
		buttonHoverColor: function (button) {
			if (typeof button.data('hover-color') !== 'undefined') {
				var hoverColor = button.data('hover-color');
				var originalColor = button.css('color');
				
				button.on('mouseenter', function () {
					qodefButton.changeColor(button, 'color', hoverColor);
				});
				button.on('mouseleave', function () {
					qodefButton.changeColor(button, 'color', originalColor);
				});
			}
		},
		changeColor: function (button, cssProperty, color) {
			button.css(cssProperty, color);
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefCountdown.init();
	});
	
	var qodefCountdown = {
		init: function () {
			this.countdowns = $('.qodef-countdown');
			
			if (this.countdowns.length) {
				this.countdowns.each(function () {
					var $thisCountdown = $(this),
						countdownElement = $thisCountdown.find('.qodef-m-date'),
						options = qodefCountdown.generateOptions($thisCountdown);
					
					qodefCountdown.initCountdown(countdownElement, options);
				});
			}
		},
		generateOptions: function(countdown) {
			var options = {};
			options.date = typeof countdown.data('date') !== 'undefined' ? countdown.data('date') : null;
			
			options.weekLabel = typeof countdown.data('week-label') !== 'undefined' ? countdown.data('week-label') : '';
			options.weekLabelPlural = typeof countdown.data('week-label-plural') !== 'undefined' ? countdown.data('week-label-plural') : '';
			
			options.dayLabel = typeof countdown.data('day-label') !== 'undefined' ? countdown.data('day-label') : '';
			options.dayLabelPlural = typeof countdown.data('day-label-plural') !== 'undefined' ? countdown.data('day-label-plural') : '';
			
			options.hourLabel = typeof countdown.data('hour-label') !== 'undefined' ? countdown.data('hour-label') : '';
			options.hourLabelPlural = typeof countdown.data('hour-label-plural') !== 'undefined' ? countdown.data('hour-label-plural') : '';
			
			options.minuteLabel = typeof countdown.data('minute-label') !== 'undefined' ? countdown.data('minute-label') : '';
			options.minuteLabelPlural = typeof countdown.data('minute-label-plural') !== 'undefined' ? countdown.data('minute-label-plural') : '';
			
			options.secondLabel = typeof countdown.data('second-label') !== 'undefined' ? countdown.data('second-label') : '';
			options.secondLabelPlural = typeof countdown.data('second-label-plural') !== 'undefined' ? countdown.data('second-label-plural') : '';
			
			return options;
		},
		initCountdown: function (countdownElement, options) {
			var $weekHTML = '<span class="qodef-digit-wrapper"><span class="qodef-label">' + '%!w:' + options.weekLabel + ',' + options.weekLabelPlural + ';</span><span class="qodef-digit">%w</span></span>';
			var $dayHTML = '<span class="qodef-digit-wrapper"><span class="qodef-label">' + '%!d:' + options.dayLabel + ',' + options.dayLabelPlural + ';</span><span class="qodef-digit">%d</span></span>';
			var $hourHTML = '<span class="qodef-digit-wrapper"><span class="qodef-label">' + '%!H:' + options.hourLabel + ',' + options.hourLabelPlural + ';</span><span class="qodef-digit">%H</span></span>';
			var $minuteHTML = '<span class="qodef-digit-wrapper"><span class="qodef-label">' + '%!M:' + options.minuteLabel + ',' + options.minuteLabelPlural + ';</span><span class="qodef-digit">%M</span></span>';
			var $secondHTML = '<span class="qodef-digit-wrapper"><span class="qodef-label">' + '%!S:' + options.secondLabel + ',' + options.secondLabelPlural + ';</span><span class="qodef-digit">%S</span></span>';
			
			countdownElement.countdown(options.date, function(event) {
				$(this).html(event.strftime($weekHTML + $dayHTML + $hourHTML + $minuteHTML + $secondHTML));
			});
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefParallaxDualImage.init();
	});
	
	var qodefParallaxDualImage = {
		init: function () {
			var parallaxIntances = $("[data-parallax]");
			
			if (parallaxIntances.length && !$('html').hasClass('touch')) {
				ParallaxScroll.init(); //initialzation removed from plugin js file to have it run only on non-touch devices
			}
			
			this.holder = $('.qodef-dual-image-with-text:odd');
			
			if (this.holder.length) {
				
				this.holder.each(function () {
					
					var holder = $(this);
					
					holder.find('.qodef-image--one .qodef-m-image-inner').css({'transition-delay': '.5s'});
					holder.find('.qodef-image--two .qodef-m-image-inner').css({'transition-delay': '.8s'});
					holder.find('.qodef-image--two-background-dots .qodef-m-image-inner').css({'transition-delay': '1s'});
				});
			}
		}
	};
	
})(jQuery);
(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.topscorer_core_google_map = {};

	$( document ).on(
		'qodefGoogleMapsCallbackEvent',
		function () {
			qodefGoogleMap.init();
		}
	);

	var qodefGoogleMap = {
		init: function () {
			this.holder = $( '.qodef-google-map' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefGoogleMap.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			if ( typeof window.qodefGoogleMap !== 'undefined' ) {
				window.qodefGoogleMap.init( $currentItem.find( '.qodef-m-map' ) );
			}
		},
	};

	qodefCore.shortcodes.topscorer_core_google_map.qodefGoogleMap = qodefGoogleMap;

})( jQuery );

(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefIcon.init();
    });

    var qodefIcon = {
        init: function () {
            this.icons = $('.qodef-icon-holder');

            if (this.icons.length) {
                this.icons.each(function () {
                    var $thisIcon = $(this);

                    qodefIcon.iconHoverColor($thisIcon);
                    qodefIcon.iconHoverBgColor($thisIcon);
                    qodefIcon.iconHoverBorderColor($thisIcon);
                });
            }
        },
        iconHoverColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-color') !== 'undefined') {
                var spanHolder = $iconHolder.find('span');
                var originalColor = spanHolder.css('color');
                var hoverColor = $iconHolder.data('hover-color');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor(spanHolder, 'color', hoverColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor(spanHolder, 'color', originalColor);
                });
            }
        },
        iconHoverBgColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-background-color') !== 'undefined') {
                var hoverBackgroundColor = $iconHolder.data('hover-background-color');
                var originalBackgroundColor = $iconHolder.css('background-color');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor($iconHolder, 'background-color', hoverBackgroundColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor($iconHolder, 'background-color', originalBackgroundColor);
                });
            }
        },
        iconHoverBorderColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-border-color') !== 'undefined') {
                var hoverBorderColor = $iconHolder.data('hover-border-color');
                var originalBorderColor = $iconHolder.css('borderTopColor');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor($iconHolder, 'border-color', hoverBorderColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor($iconHolder, 'border-color', originalBorderColor);
                });
            }
        },
        changeColor: function (iconElement, cssProperty, color) {
            iconElement.css(cssProperty, color);
        }
    };

    qodefCore.qodefIcon = qodefIcon;

})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefProgressBar.init();
    });

    var qodefProgressBar = {
        init: function () {
            this.holder = $('.qodef-progress-bar');

            if (this.holder.length) {
                this.holder.each(function () {
                    var $thisHolder = $(this),
                        layout = $thisHolder.data('layout'),
                        data = qodefProgressBar.generateBarData($thisHolder, layout),
                        container = '#qodef-m-canvas-' + $thisHolder.data('rand-number'),
                        number = $thisHolder.data('number') / 100;

                    switch (layout) {
                        case 'circle':
	                        $(container).appear(function () {
		                        setTimeout(function () {
			                        qodefProgressBar.initCircleBar(container, data, number);
		                        }, 200);
	                        });
                            
                            break;
                        case 'semi-circle':
                            qodefProgressBar.initSemiCircleBar(container, data, number);
                            break;
                        case 'line':
                            number = $thisHolder.data('number');
                            container = $thisHolder.find('.qodef-m-canvas');
                            data = qodefProgressBar.generateLineData($thisHolder, layout, number);
	
	                        $(container).appear(function () {
		                        setTimeout(function () {
			                        qodefProgressBar.initLineBar(container, data);
		                        }, 200);
	                        });
                            
                            break;
                        case 'custom':
                            container = "#" + $thisHolder.data('custom-shape-id');
                            qodefProgressBar.initCustomBar(container, data, number);
                            break;
                    }
                });
            }
        },
        generateBarData: function (thisBar, layout) {
            var activeWidth = thisBar.data('active-line-width');
            var activeColor = thisBar.data('active-line-color');
            var inactiveWidth = thisBar.data('inactive-line-width');
            var inactiveColor = thisBar.data('inactive-line-color');
            var easing = 'linear';
            var duration = 1400;
            var textColor = thisBar.data('text-color');

            return {
                strokeWidth: activeWidth,
                color: activeColor,
                trailWidth: inactiveWidth,
                trailColor: inactiveColor,
                easing: easing,
                duration: duration,
                svgStyle: {width: '100%', height: '100%'},
                text: {
                    style: {
                        color: textColor
                    },
                    autoStyleContainer: false
                },
                from: {color: inactiveColor},
                to: {color: activeColor},
                step: function (state, bar) {
                    if (layout !== 'custom') {
                        bar.setText(Math.round(bar.value() * 100) + '<span class="qodef-m-precent">%</span>');
                    }
                }
            };
        },
        initCircleBar: function (container, data, number) {
            var bar = new ProgressBar.Circle(container, data);
            bar.animate(number);
        },
        initSemiCircleBar: function (container, data, number) {
            var bar = new ProgressBar.SemiCircle(container, data);
            bar.animate(number);
        },
        initCustomBar: function (container, data, number) {
            var bar = new ProgressBar.Path(container, data);
            bar.set(0);
            bar.animate(number);
        },
        generateLineData: function (thisBar, layout, number) {
            var height = thisBar.data('active-line-width');
            var activeColor = thisBar.data('active-line-color');
            var inactiveHeight = thisBar.data('inactive-line-width');
            var inactiveColor = thisBar.data('inactive-line-color');
            var duration = 1400;
            var textColor = thisBar.data('text-color');

            return {
                percentage: number,
                duration: duration,
                fillBackgroundColor: activeColor,
                backgroundColor: inactiveColor,
                height: height,
                inactiveHeight: inactiveHeight,
                followText: true,
                textColor: textColor
            };
        },
        initLineBar: function (container, data) {
            container.LineProgressbar(data);
        }
    };

})(jQuery);
(function($){
    "use strict";

    var fixedHeaderAppearance = {
        showHideHeader: function($pageOuter, $header){
            if(qodef.windowWidth > 1024) {
                if (qodef.scroll <= 0) {
                    qodef.body.removeClass('qodef-header--fixed-display');
                    $pageOuter.css('padding-top', '0');
                    $header.css('margin-top', '0');
                } else {
                    qodef.body.addClass('qodef-header--fixed-display');
                    $pageOuter.css('padding-top', parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight) + 'px');
                    $header.css('margin-top', parseInt(qodefGlobal.vars.topAreaHeight) + 'px');
                }
            }
        },
        init: function(){
            var $pageOuter = $('#qodef-page-outer'),
                $header = $('#qodef-page-header');
            fixedHeaderAppearance.showHideHeader($pageOuter, $header);
            $(window).scroll(function() {
                fixedHeaderAppearance.showHideHeader($pageOuter, $header);
            });
            $(window).resize(function() {
                $pageOuter.css('padding-top', '0');
                fixedHeaderAppearance.showHideHeader($pageOuter, $header);
            });
        }
    };
    
    qodef.fixedHeaderAppearance = fixedHeaderAppearance.init;

})(jQuery);
(function ($) {
    "use strict";

    var stickyHeaderAppearance = {
        displayAmount: function () {

            if (qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0) {
                return parseInt(qodefGlobal.vars.qodefStickyHeaderScrollAmount);
            } else {
                return parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight);
            }
        },
        showHideHeader: function (displayAmount) {

            if (qodef.scroll < displayAmount) {
                qodef.body.removeClass('qodef-header--sticky-display');
            } else {
                qodef.body.addClass('qodef-header--sticky-display');
            }
        },
        init: function () {
            var displayAmount = stickyHeaderAppearance.displayAmount();

            stickyHeaderAppearance.showHideHeader(displayAmount);
            $(window).scroll(function () {
                stickyHeaderAppearance.showHideHeader(displayAmount);
            });
        }
    };

    qodef.stickyHeaderAppearance = stickyHeaderAppearance.init;

})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function(){
        qodefSearchCoversHeader.init();
    });

    var qodefSearchCoversHeader = {
        init: function(){
            var $searchOpener = $('a.qodef-search-opener'),
                $searchForm = $('form.qodef-search-cover'),
                $searchClose = $('.qodef-search-close');

            if ($searchOpener.length && $searchForm.length) {
                $searchOpener.on('click', function (e) {
                    e.preventDefault();
                    qodefSearchCoversHeader.openCoversHeader($searchForm);

                });
                $searchClose.on('click', function (e) {
                    e.preventDefault();
                    qodefSearchCoversHeader.closeCoversHeader($searchForm);
                });
            }
        },
        openCoversHeader: function($searchForm){
            qodef.body.addClass('qodef-covers-search--opened qodef-covers-search--fadein');
            qodef.body.removeClass('qodef-covers-search--fadeout');

            setTimeout(function () {
                $searchForm.find('.qodef-search-field').focus();
            }, 600);
        },
        closeCoversHeader: function($searchForm){
            qodef.body.removeClass('qodef-covers-search--opened qodef-covers-search--fadein');
            qodef.body.addClass('qodef-covers-search--fadeout');

            setTimeout(function () {
                $searchForm.find('.qodef-search-field').val('');
                $searchForm.find('.qodef-search-field').blur();
                qodef.body.removeClass('qodef-covers-search--fadeout');
            }, 300);
        }
    };

})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefProgressBarSpinner.init();
	});
	
	var qodefProgressBarSpinner = {
		percentNumber: 0,
		init: function () {
			this.holder = $('#qodef-page-spinner.qodef-layout--progress-bar');
			
			if (this.holder.length) {
				qodefProgressBarSpinner.animateSpinner(this.holder);
			}
		},
		animateSpinner: function ($holder) {
			
			var $numberHolder = $holder.find('.qodef-m-spinner-number-label'),
				$spinnerLine = $holder.find('.qodef-m-spinner-line-front'),
				numberIntervalFastest,
				windowLoaded = false;
			
			$spinnerLine.animate({'width': '100%'}, 10000, 'linear');
			
			var numberInterval = setInterval(function () {
				qodefProgressBarSpinner.animatePercent($numberHolder, qodefProgressBarSpinner.percentNumber);
			
				if (windowLoaded) {
					clearInterval(numberInterval);
				}
			}, 100);
			
			$(window).on('load', function () {
				windowLoaded = true;
				
				numberIntervalFastest = setInterval(function () {
					if (qodefProgressBarSpinner.percentNumber >= 100) {
						clearInterval(numberIntervalFastest);
						$spinnerLine.stop().animate({'width': '100%'}, 500);
						
						setTimeout(function () {
							$holder.addClass('qodef--finished');
							
							setTimeout(function () {
								qodefProgressBarSpinner.fadeOutLoader($holder);
							}, 1000);
						}, 600);
					} else {
						qodefProgressBarSpinner.animatePercent($numberHolder, qodefProgressBarSpinner.percentNumber);
					}
				}, 6);
			});
		},
		animatePercent: function ($numberHolder, percentNumber) {
			if (percentNumber < 100) {
				percentNumber += 5;
				$numberHolder.text(percentNumber);
				
				qodefProgressBarSpinner.percentNumber = percentNumber;
			}
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';
			
			$holder.delay(delay).fadeOut(speed, easing);
			
			$(window).on('bind', 'pageshow', function (event) {
				if (event.originalEvent.persisted) {
					$holder.fadeOut(speed, easing);
				}
			});
		}
	};
	
})(jQuery);
(function ($) {
    "use strict";

    $(window).on('load', function () {
            qodefTestimonials.init();
        }
    );

    var qodefTestimonials = {
        init: function () {
            this.holder = $('.qodef-testimonials-list.qodef-swiper-container');

            if (this.holder.length) {
                this.holder.each(function () {
                    var $thisHolder = $(this),
                        swiperInstance = $thisHolder[0].swiper,
                        swiperParams = swiperInstance.params;

                    swiperInstance.destroy(false, true);//destroy swiper instance, reinit it later

                    var height = 0,
                        currentHeight = 0,
                        $items = $thisHolder.find('.qodef-e');

                    if ($items.length) {
                        $items.each(
                            function () {
                                currentHeight = $(this).outerHeight();

                                if (currentHeight > height) {
                                    height = currentHeight;
                                }
                            }
                        );
                    }

                    swiperParams.on.beforeInit = function(){
                        $thisHolder.find('.swiper-wrapper').css('height', height);
                        $items.css('height', height);
                    }

                    var newSwiperInstance = new Swiper($thisHolder[0], swiperParams);//init swiper instance with recalculated height
                });
            }
        }
    };

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefBlogMetroCounter.init();
	});
	
	//Add counter number
	
	var qodefBlogMetroCounter = {
		init: function () {
			this.holder = $('.qodef-blog.qodef-counter--yes div');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $holder = $(this),
						numberHolder = $holder.children('article').find('.qodef-e-counter');
					
					numberHolder.each(function (i) {
						i++;
						$(this).append( "<span class='qodef-m-character'>0</span><span class='qodef-m-character'>" + i + "</span>" );
					});
				});
			}
		}
	};
	
})(jQuery);