/**
* Main/Entry JS file for theme
* ----------------------------
* @package gyaan
* @since 1.0.0
*/
'use strict';

// import modules
import DropdownMenu from './modules/menu';
import GyaanSidebar from './modules/sidebar.js';
import 'bootstrap/js/dist/carousel';
import CardLayout from './modules/card-layout';
import ValidateForms from './modules/validate.js';

jQuery(document).ready(function($) {
	// Custom dropdown menu
	//====================================================
	let dropdownMenu = new DropdownMenu($("#top-menu"));

	// Gyaan: Sidebar
	//====================================================
	let sidebar = new GyaanSidebar($("#gyaan-sidebar-wrapper"));

	// Masonry card layout
	//====================================================
	const cardContainerSelector = '.post-cards-container';
	const $cardContainer = $(cardContainerSelector);
	if($cardContainer.length) {
		let cardLayout = new CardLayout($cardContainer);
	}

	// Form Validation
	//====================================================
	let validateForm = new ValidateForms();
});