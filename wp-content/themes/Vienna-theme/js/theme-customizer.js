/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// Update the site title in real time...
	wp.customize('border-radius-input', function(value){ 
        value.bind(function(newval){ 
            $('.pm-header-logo-style3').css('border-radius', newval);
        });
    });
	
	
} )( jQuery );