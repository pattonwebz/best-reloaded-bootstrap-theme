/**
 * scripts.js
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.1
 */
var debug = true;
jQuery(document).ready(function($){
    // if #social-block exists then do this...
    // TODO: Add on/off toggle here
    if( $('#social').length ){
        // set #social to the same height as #social-block
        $('#social').height($("#social-block").height());
        // sets width of the div with buttons to be the same as it's main container
        $('#social-block').width($("#main_content").width());
        // get the postion of #social-block inside the viewport
        var socialTop = $('#social-block')[0].getBoundingClientRect().top;
        if(debug){
            console.log(socialtop,' initial value of socialTop' );
        }
        // affixes the div whenever scroll past it
        if ( $('header nav.navbar').hasClass('navbar-fixed-top') ){
            socialTop = socialTop + 50;
            if(debug){
                console.log(socialtop,' updated value of socialTop' );
            }
        }
        if(debug){
            console.log(socialtop,' using this value for socialTop' );
        }
        $('#social-block').affix({
            offset: { top: socialTop }
        });
    }
});
