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
		this.events();
	}

	// events
	events() {
		this.$mainContainer.on('click', this.loadMoreBtnSelector, this.displayPosts.bind(this));
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
}

export default LoadPostCards;