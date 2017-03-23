/**
 * scripts.js
 *
 *
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.9
 */
jQuery(document).ready(function($){
    // deal with very long titles
    if( $('.name-text .site-title').height() > 110 ){
		$('.name-text .site-title').addClass('long-title');
	}
});
