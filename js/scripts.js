/**
* Main/Entry JS file for theme
* ----------------------------
* @package gyaan
* @since 1.0.0
*/
'use strict';

// import modules
import 'bootstrap/js/dist/carousel';

import DropdownMenu from './modules/menu';
import GyaanSidebar from './modules/sidebar';
import CardLayout from './modules/card-layout';
import ValidateForms from './modules/validate';
import ExtraFeatures from './modules/extra-features';

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
		let cardLayout = new CardLayout(cardContainerSelector);
	}

	// Form Validation
	//====================================================
	let validateForm = new ValidateForms();

	// Extra Features
	//====================================================
	let extras = new ExtraFeatures();

console.log($('iframe').length);
	$('iframe').each(function () {
  var $randid = Math.floor(Math.random() * 101);
  $(this).attr({'id': 'goinOnaSafari-' + $randid});

  var $frame = document.getElementById('goinOnaSafari-' + $randid);
  $frame.contentWindow.location.href = $frame.src;
});
});