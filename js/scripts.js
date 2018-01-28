/**
* Main/Entry JS file for theme
* ----------------------------
* @package gyaan
* @since 1.0.0
*/
'use strict';

// import modules
import 'bootstrap/js/dist/carousel';
import jQueryBridget from 'jquery-bridget';
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';
import DropdownMenu from './modules/menu.js';
import LoadPosts from './modules/load-post-cards.js';

jQuery(document).ready(function($) {
	// Custom dropdown menu
	//=====================
	let dropdownMenu = new DropdownMenu($("#top-menu"));
	
	// Masonry grid layout
	//====================
	/* make Masonry a jQuery plugin */
	jQueryBridget('masonry', Masonry, $);
	const $grid = $('.post-cards-container');
	if($grid.length) {
		$grid.masonry({
			itemSelector: '.card-wrapper',
			columnWidth: '.card-wrapper',
			percentPosition: true
		});
		/* when each image is loaded, layout Masonry */
		imagesLoaded.makeJQueryPlugin($);
		$grid.imagesLoaded().progress(function() {
			$grid.masonry('layout');
		});

		// Load posts
		//===========
		var loadPosts = new LoadPosts($("#main"));
	}

});