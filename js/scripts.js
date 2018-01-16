/**
* Main/Entry JS file for theme
* ----------------------------
* @package gyaan
* @since 1.0.0
*/
'use strict';

// import modules
import Masonry from 'masonry-layout';
import DropdownMenu from './modules/menu.js';

jQuery(document).ready(function($) {
	// Custom dropdown menu
	var dropdownMenu = new DropdownMenu($("#top-menu"));
	
	// Masonry grid layout
	var msnry = new Masonry('.post-cards', {
		itemSelector: '.card-wrapper',
	  	columnWidth: '.card-wrapper',
	  	percentPosition: true,
	  	horizontalOrder: true
	});
});