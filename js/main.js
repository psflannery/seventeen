/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
( function() {
	var container, button, menu, links, subMenus;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( var i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )();

/**
 * skip-link0focus-fix.js
 */
( function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();

// Main functionality scripts
( function ($) {
	/**
	 * Masonry and Images Loaded
	 */
	masonryImgLoaded = function() {
		var $container = $('.masonry-container');
		// Initialize Masonry after al images have loaded
		$container.imagesLoaded(function() {
			$container.masonry({
				itemSelector: '.masonry-item',
				columnWidth: '.masonry-item',
				percentPosition: true,
			});
		});
	}
	
	/**
	 * Cycle 2 slideshow
	 *
	 * Additional Controls
	 */
	cycle2SlideShow = function() {
		$(document.documentElement).keyup(function (e) {
			if (e.keyCode == 39) {        
			   $('.cycle-slideshow').cycle('next');
			}
			else if (e.keyCode == 37) {
				$('.cycle-slideshow').cycle('prev');
			}
		});
	};
	
    /**
	 * Layout Hacks
	 *
	 * Mostly small hacks and tweaks to configure the layout, some of which are often simpler to do like this than through the Wordpress backend.
	 * All of these need to be called back after the ajax page load.
	 *
	 * In time all of these should be imlpemented server side.
	 */
	layout_hacks = function() {
		/* Remove inline styles from wp-caption */
		// http://wordpress.stackexchange.com/questions/89221/removing-inline-styles-from-wp-caption-div
		$(".wp-caption").removeAttr('style');
				
		/* Wordpress placeholder hack */
		$('.search-field').attr("placeholder", "Search");
		
		/* Remove class `.row` from posts that don't use the new shortcode structure */
		$('.entry-content:not(:has(div[class*="col-"]))').removeClass('row');
	};
    
    /**
	 * Layout
	 *
	 * Various functions to help layout the page.
	 *
	 * These all need to be wrapped in a function so that they can be called back after an ajax page load.
	 */
	layout = function() {
		if ($.fn.imagesLoaded) {
			masonryImgLoaded();
		}
		cycle2SlideShow();
		layout_hacks();
        
        /* FitVids */
		$(".fitvids").fitVids();
        
    };
    
    /**
     * Prevent iOS from zooming onfocus
     * https://github.com/h5bp/mobile-boilerplate/pull/108
     * Adapted from original jQuery code here: http://nerd.vasilis.nl/prevent-ios-from-zooming-onfocus/
     */
    var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]');

    preventZoom = function() {
        if (viewportmeta && navigator.platform.match(/iPad|iPhone|iPod/i)) {
            var formFields = document.querySelectorAll('input, select, textarea');
            var contentString = 'width=device-width,initial-scale=1,maximum-scale=';
            var i = 0;
            var fieldLength = formFields.length;

            var setViewportOnFocus = function() {
                viewportmeta.content = contentString + '1';
            };

            var setViewportOnBlur = function() {
                viewportmeta.content = contentString + '10';
            };

            for (; i < fieldLength; i++) {
                formFields[i].onfocus = setViewportOnFocus;
                formFields[i].onblur = setViewportOnBlur;
            }
        }
    };
})( jQuery );

// Launch
jQuery(document).ready(function($) {
    layout();
    preventZoom();
});