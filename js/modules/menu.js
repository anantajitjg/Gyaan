/**
* Dropdown menu module
* --------------------
*/
window.Collapse = require("exports-loader?Collapse!bootstrap/js/dist/collapse");

class DropdownMenu {
	constructor($elem) {
		this.$elem = $elem;
		this.toggleBtn = $('.navbar-toggler');
		this.dropdownSelector = '.dropdown';
		this.subMenuSelector = '.dropdown-menu'; 
		this.initDropdown();
	}
	initDropdown() {
		if(!this.toggleBtn.is(":visible")) {
			this.$elem.find(this.dropdownSelector).hover(this.dropDownHandler.bind(this));
		}
	}
	dropDownHandler(e) {
		let sub_menu = $(e.currentTarget).find(this.subMenuSelector).first();
		if(e.type == 'mouseenter') {
			sub_menu.stop(true, true).fadeIn("slow");
		} else {
			sub_menu.stop(true, true).fadeOut();
		}
	}
}
export default DropdownMenu;