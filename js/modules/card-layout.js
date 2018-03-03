/**
* card layout using Masonry
* -------------------------
*/
import jQueryBridget from 'jquery-bridget';
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';
import InfiniteScroll from 'infinite-scroll';
import 'bootstrap/js/dist/carousel';

class CardLayout {
	constructor(containerSelector) {
		this.cardContainerSelector = containerSelector;
		this.itemSelector = '.card-wrapper';
		this.columnWidth = '.card-wrapper';
		this.paginationSelector = '.pagination-wrapper';
		this.statusSelector = '.page-load-status';
		this.$pageNavigation = $('.page-navigation');
		this.fullURL = window.location.href;
		this.nextPageURL = '';
		this.initLayout();
	}
	
	initLayout() {
		const $cardContainer = $(this.cardContainerSelector);

		/* make Masonry a jQuery plugin */
		jQueryBridget('masonry', Masonry, $);
		$cardContainer.masonry({
			itemSelector: this.itemSelector,
			columnWidth: this.columnWidth,
			percentPosition: true,
			transitionDuration: '0.7s',
			stagger: 50,
			visibleStyle: { transform: 'translateY(0)', opacity: 1 },
			hiddenStyle: { transform: 'translateY(100px)', opacity: 0 }
		});
		this.layoutOnImgLoad($cardContainer);

		// initialize infinite scroll
		let max_pages = $cardContainer.data('maxPages');
		if(max_pages > 1) {
			let paged = $cardContainer.data('paged');
			if( max_pages == paged ) {
				$(this.statusSelector).css('display', 'block').children('div:not(.infinite-scroll-error)').css('display', 'none');
				$(this.paginationSelector).css('display', 'none');
			} else {
				this.layoutOnScroll($cardContainer);
			}
		} 
	}

	/* when each image is loaded, layout Masonry */
	layoutOnImgLoad($container) {
		imagesLoaded.makeJQueryPlugin($);
		$container.imagesLoaded().progress(function() {
			$container.masonry('layout');
		});
	}

	/* update the next page URL on load event for infinite scroll */
	updateNextPageURL(doc) {
		this.nextPageURL = $(doc).find(this.cardContainerSelector).data('next');
	}

	/* card layout on scrolling with infinite scroll */
	layoutOnScroll($container) {
		let me = this;
		jQueryBridget('infiniteScroll', InfiniteScroll, $);
		InfiniteScroll.imagesLoaded = imagesLoaded;
		// get Masonry instance
		let msnry = $container.data('masonry');
		me.updateNextPageURL(document);
		// enable previous page navigation for pages
		if(gyaanData.is_paged) {
			me.$pageNavigation.css('display', 'block');
		}

		$container.infiniteScroll({
			path: function() {
				return me.nextPageURL;
			},
			append: me.itemSelector,
			outlayer: msnry,
			hideNav: me.paginationSelector,
			status: me.statusSelector,
			onInit: function() {
				this.on('history', me.onHistoryChange.bind(me));
			}
		});
		let infScroll = $container.data('infiniteScroll');
		infScroll.on('load', function(response) {
			me.updateNextPageURL(response);
		});
		this.onLayoutComplete(msnry);
	}

	/* when masonry layout is completed */
	onLayoutComplete($instance) {
		$instance.on('layoutComplete', function(items) {
			if(items.length) {
				items.forEach((item) => {
					const $carousel = $(item.element).find(".carousel");
					if($carousel.length) {
						// activate carousel
						$carousel.carousel();
					}
				});
			}
		});
	}

	/* show/hide page navigation when history changes */
	onHistoryChange(title, path) {
		if(gyaanData.is_paged) {
			const $navElem = this.$pageNavigation;
			const page_full_url = this.fullURL;
			$navElem.fadeOut();
			if(page_full_url == path) {
				$navElem.fadeIn();
			}
		}
	}

	/* append content to current card layout */
	appendToLayout($container, $content) {
		$container.append($content).masonry('appended', $content);
		this.layoutOnImgLoad($container);
	}
}

export default CardLayout;