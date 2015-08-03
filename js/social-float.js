var $ = jQuery.noConflict(); // set the $ variable to be jQuery

$('#social').height($("#social-block").height()); // sets #social to the same width as #social-block
$('#social-block').width($("#main_content").width()); // sets width of the div with buttons to be the same as it's main container
$('#social-block').affix({
offset: $('#social-block').position()
}); // affixes the div whenever scroll past it