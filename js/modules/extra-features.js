/**
* Extra features
* --------------
*/

class ExtraFeatures {
	constructor() {
		this.$backToTop = $(".back-to-top");
		this.events();
	}

	events() {
		$(window).on("scroll", this.displayBackToTop.bind(this));
		this.$backToTop.find("a").on("click", this.backToTop.bind(this));
	}

	// methods
	displayBackToTop() {
		if($(window).scrollTop() > 100) {
			this.$backToTop.addClass("active");
		} else {
			this.$backToTop.removeClass("active");
		}
	}

	backToTop(e) {
		e.preventDefault();
		$("body, html").stop().animate({ scrollTop: 0 }, 500);
	}
}

export default ExtraFeatures;