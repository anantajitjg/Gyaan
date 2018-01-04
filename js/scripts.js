/**
* Main/Entry JS file for theme
* ----------------------------
* @package gyaan
* @since 1.0.0
*/
'use strict';

// import modules
import DropdownMenu from './modules/menu.js';

jQuery(document).ready(function($) {
	var dropdownMenu = new DropdownMenu($("#top-menu"));
});