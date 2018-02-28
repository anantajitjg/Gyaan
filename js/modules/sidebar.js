/**
* Sidebar module
* --------------
*/

class GyaanSidebar {
	constructor($sidebarWrapper) {
		this.$sidebarWrapper = $sidebarWrapper;
		this.$sidebarToggle = $('.sidebar-toggle-btn');
		this.$sidebarClose = $('.sidebar-close-btn');
		this.$sidebarOverlay = $('.sidebar-overlay');
		this.hiddenClass = 'sidebar-hidden';
		this.activeClass = 'sidebar-active';
		this.events();
	}

	events() {
		this.$sidebarToggle.on('click', this.sidebar.bind(this, 'toggle'));
		this.$sidebarClose.on('click', this.sidebar.bind(this, 'close'));
		this.$sidebarOverlay.on('click', this.sidebar.bind(this, 'close'));
	}

	sidebar(status) {
		const hidden_class = this.hiddenClass;
		const active_class = this.activeClass;

		if(status === 'toggle') {
			$('body').toggleClass('no-scroll');
			this.$sidebarWrapper.toggleClass(hidden_class + ' ' + active_class);
			this.$sidebarToggle.toggleClass('active');
			this.$sidebarOverlay.fadeToggle();
		} else {
			this.$sidebarWrapper.addClass(hidden_class).removeClass(active_class);
			this.$sidebarToggle.removeClass('active');
			this.$sidebarOverlay.fadeOut();
			$('body').removeClass('no-scroll');
		}
	}
}

export default GyaanSidebar;