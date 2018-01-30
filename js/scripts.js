/**
* Main/Entry JS file for theme
* ----------------------------
* @package gyaan
* @since 1.0.0
*/
'use strict';

// import modules
import DropdownMenu from './modules/menu';
import 'bootstrap/js/dist/carousel';
import CardLayout from './modules/card-layout';
import LoadPosts from './modules/load-post-cards';

jQuery(document).ready(function($) {
	// Custom dropdown menu
	//=====================
	let dropdownMenu = new DropdownMenu($("#top-menu"));

	const cardContainerSelector = '.post-cards-container';
	const $cardContainer = $(cardContainerSelector);
	if($cardContainer.length) {
		// Masonry card layout
		//==============================================
		let cardLayout = new CardLayout($cardContainer);

		// Load posts
		//==============================================
		let loadPosts = new LoadPosts($("#main"), cardContainerSelector, cardLayout);
	}
});