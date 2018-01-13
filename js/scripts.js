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
	var dropdownMenu = new DropdownMenu($("#top-menu"));
	var msnry = new Masonry('.post-cards', {
		itemSelector: '.card',
	  	columnWidth: '.card',
	  	percentPosition: true,
	  	gutter: 20,
	  	horizontalOrder: true
	});
});