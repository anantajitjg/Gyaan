/**
* Main/Entry JS file for theme
* ----------------------------
* @package gyaan
* @since 1.0.0
*/
'use strict';

// import modules
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';
import DropdownMenu from './modules/menu.js';

jQuery(document).ready(function($) {
	// Custom dropdown menu
	//=====================
	var dropdownMenu = new DropdownMenu($("#top-menu"));
	
	// Masonry grid layout
	//====================
	var grid_selector = '.post-cards';
	var msnry = new Masonry(grid_selector, {
		itemSelector: '.card-wrapper',
	  	columnWidth: '.card-wrapper',
	  	percentPosition: true,
	  	horizontalOrder: true
	});
	// when each image is loaded, layout Masonry
	imagesLoaded.makeJQueryPlugin($);
	$(grid_selector).imagesLoaded().progress(function() {
		msnry.layout();
	});
});