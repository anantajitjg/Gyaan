/**
* Load posts (cards) using WordPress Ajax Process Execution (admin-ajax)
* ----------------------------------------------------------------------
*/
import 'bootstrap/js/dist/carousel';

class LoadPostCards {
	constructor($mainContainer, cardContainerSelector, msnry) {
		this.$mainContainer = $mainContainer;
		this.$cardContainer = this.$mainContainer.find(cardContainerSelector);
		this.msnry = (typeof msnry !== 'undefined') ? msnry : false;
		this.loadMoreBtnSelector = '.load-more-btn';
		this.page = 2;
		this.scrollPrev = 0;
		this.events();
	}

	// events
	events() {
		//this.$mainContainer.on('click', this.loadMoreBtnSelector, this.displayPosts.bind(this));
		//$(window).on('scroll', this.onWindowScroll.bind(this));
	}

	// methods
	displayPosts(e) {
		const btn = $(e.target);
		btn.prop('disabled', true);

		$.ajax({
			url: gyaanData.ajax_url,
			method: "POST",
			data: {
				action: 'gyaan_load_cards',
				page: this.page
			}
		}).done((res) => {
			if(res.length > 0) {
				this.page++;
				const $content = $(res);
				const $container = this.$cardContainer;
				const carousel_sel = '.carousel';

				if(this.msnry) {
					// masonry card layout
					this.msnry.appendToLayout($container, $content);
				} else {
					$container.append($content);
				}
				// activate carousel
				if($container.find(carousel_sel).length) {
					$container.find(carousel_sel).carousel();
				}
				
				btn.prop('disabled', false);
			}
		}).fail((res) => {
			console.log("Error!");
		});
	}

	isPageVisible($elem) {
		let scrollTop = $(window).scrollTop();
		let windowHeight = $(window).height();
		let elem_top = $elem.offset().top;
		let elem_height = $elem.height();
		console.log(elem_height);
		let elem_bottom = elem_top + elem_height;
		let isVisible = ( (elem_bottom - elem_height * 0.25 > scrollTop) && (elem_top < (scrollTop + windowHeight * 0.5)) );
		return isVisible;
	}

	onWindowScroll() {
		let scrollTop = $(window).scrollTop();
		let heightLimit = ($(window).height()) * 0.1;
		if(Math.abs(scrollTop - this.scrollPrev) > heightLimit) {
			let me = this;
			me.scrollPrev = scrollTop;
			me.$mainContainer.find('.gyaan-pagination').each(function(i) {
				//console.log(me.isPageVisible($(this)));
				me.isPageVisible($(this));
			});
		}
	}
}

export default LoadPostCards;