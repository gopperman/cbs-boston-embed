<?php
/**
 * Plugin Name: CBS Boston Embed
 * Plugin URI: http://www.boston.com
 * Description: Allow authors to embed CBS Boston videos into pages / posts
 * Version: 0.1.0
 * Author: Greg Opperman
 * Author URI: http://www.boston.com
 *
 * @package bdc.espn-embed
 * @version 0.1.0
 * @author Greg Opperman <gregory.opperman@globe.com>
 */

// Example URL: http://up.anv.bz/latest/anvload.html?key=eyJtIjoiY2JzIiwicCI6ImRlZmF1bHQiLCJ2IjoiMzM3NDE1MyIsInBsdWdpbnMiOnsiY29tc2NvcmUiOnsiY2xpZW50SWQiOiIzMDAwMDIzIiwiYzMiOiJCb3N0b24uY2JzbG9jYWwuY29tIn0sImRmcCI6eyJjbGllbnRTaWRlIjp7ImFkVGFnVXJsIjoiaHR0cDovL3B1YmFkcy5nLmRvdWJsZWNsaWNrLm5ldC9nYW1wYWQvYWRzP3N6PTJ4MiZpdT0vNDEyOC9DQlMuQk9TVE9OJmNpdV9zenMmaW1wbD1zJmdkZnBfcmVxPTEmZW52PXZwJm91dHB1dD14bWxfdmFzdDImdW52aWV3ZWRfcG9zaXRpb25fc3RhcnQ9MSZ1cmw9W3JlZmVycmVyX3VybF0mZGVzY3JpcHRpb25fdXJsPVtkZXNjcmlwdGlvbl91cmxdJmNvcnJlbGF0b3I9W3RpbWVzdGFtcF0iLCJrZXlWYWx1ZXMiOnsiY2F0ZWdvcmllcyI6IltbQ0FURUdPUklFU11dIiwicHJvZ3JhbSI6IltbUFJPR1JBTV9OQU1FXV0iLCJzaXRlU2VjdGlvbiI6ImRsIn19fSwiaGVhcnRiZWF0QmV0YSI6eyJhY2NvdW50IjoiY2JzbG9jYWwtZ2xvYmFsLXVuaWZpZWQsY2JzbG9jYWwtc3RhdGlvbi1ib3N0b24tYm9zdG9uLXVuaWZpZWQsY2JzbG9jYWwtc3VicHJpbWFyeS1zd3R2LXVuaWZpZWQsY2JzbG9jYWwtbWFya2V0LWJvc3Rvbi11bmlmaWVkIiwicHVibGlzaGVySWQiOiI4MjNCQTAzMzU1Njc0OTdGN0YwMDAxMDFAQWRvYmVPcmciLCJqb2JJZCI6InNjX3ZhIiwibWFya2V0aW5nQ2xvdWRJZCI6IjgyM0JBMDMzNTU2NzQ5N0Y3RjAwMDEwMUBBZG9iZU9yZyIsInRyYWNraW5nU2VydmVyIjoiY2JzZGlnaXRhbG1lZGlhLmhiLm9tdHJkYy5uZXQiLCJjdXN0b21UcmFja2luZ1NlcnZlciI6ImNic2RpZ2l0YWxtZWRpYS5kMS5zYy5vbXRyZGMubmV0IiwidmVyc2lvbiI6IjEuNSJ9LCJyZWFsVGltZUFuYWx5dGljcyI6dHJ1ZX0sImFudmFjayI6ImFudmF0b19jYnNsb2NhbF9hcHBfd2ViX3Byb2RfNTQ3ZjNlNDkyNDFlZjBlNWQzMGM3OWIyZWZiY2E1ZDkyYzY5OGY2NyJ9
// SERIOUSLY
define( 'BDC_CBSBOSTON_EMBED_REGEX', '#^https?://(www.)?up\.anv\.bz/latest/anvload\.html\?key=.*#' );

class CBS_Boston_Embed {
	/**
	 * Set up the default handlers for embedding
	*/
	function __construct() {

		// Example URL: http://cinesport.boston.com/boston-globe-sports/manning-reflects-win-over-brady-pats/
		wp_embed_register_handler( 'cbsboston', BDC_CBSBOSTON_EMBED_REGEX, array( $this, 'cbs_boston_embed_handler' ) );

		add_shortcode( 'cbsboston', array( $this, 'cbs_boston_shortcode_handler' ) );
	}

	function cbs_boston_embed_handler( $matches, $attr, $url ) {
		return '<div class="content-media__video"><iframe scrolling="no" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen src="' . $url . '"  width ="640" height="360"></iframe></div>';
	}

	function cbs_boston_shortcode_handler( $atts ) {
		global $wp_embed;
		if ( empty( $atts['url'] ) ) {
			return;
		}
		if ( ! preg_match( BDC_CBSBOSTON_EMBED_REGEX, $atts['url'] ) ) {
			return;
		}
		return $wp_embed->shortcode( $atts, $atts['url'] );
	}
}

new CBS_Boston_Embed;


