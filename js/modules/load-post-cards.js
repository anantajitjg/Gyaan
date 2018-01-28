/**
* Load posts (cards) using WordPress Ajax Process Execution (admin-ajax)
* ----------------------------------------------------------------------
*/
import jQueryBridget from 'jquery-bridget';
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';

class LoadPostCards {
	constructor($elem) {
		this.$elem = $elem;
		this.loadMoreBtnSelector = '.load-more-btn';
		this.cardContainer = this.$elem.find('.post-cards-container');
		this.page = 2;
		this.events();
	}

	// events
	events() {
		this.$elem.on('click', this.loadMoreBtnSelector, this.displayPosts.bind(this));
	}

	// methods
	displayPosts(e) {
		let btn = $(e.target);
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
				const $container = this.cardContainer;
				const carousel_sel = '.carousel';

				// masonry grid layout
				jQueryBridget('masonry', Masonry, $);
				$container.append($content).masonry('appended', $content);
				imagesLoaded.makeJQueryPlugin($);
				$container.imagesLoaded().progress(function() {
					$container.masonry('layout');
				});

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