/**
* card layout using Masonry
* -------------------------
*/
import jQueryBridget from 'jquery-bridget';
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';
import InfiniteScroll from 'infinite-scroll';

class CardLayout {
	constructor($cardContainer) {
		this.$cardContainer = $cardContainer;
		this.itemSelector = '.card-wrapper';
		this.columnWidth = '.card-wrapper';
		this.initLayout();
	}
	
	initLayout() {
		/* make Masonry a jQuery plugin */
		jQueryBridget('masonry', Masonry, $);
		this.$cardContainer.masonry({
			itemSelector: this.itemSelector,
			columnWidth: this.columnWidth,
			percentPosition: true,
			transitionDuration: '0.7s',
			stagger: 50,
			visibleStyle: { transform: 'translateY(0)', opacity: 1 },
			hiddenStyle: { transform: 'translateY(100px)', opacity: 0 }
		});
		this.layoutOnImgLoad(this.$cardContainer);
		this.layoutOnScroll(this.$cardContainer);
	}

	/* when each image is loaded, layout Masonry */
	layoutOnImgLoad($container) {
		imagesLoaded.makeJQueryPlugin($);
		$container.imagesLoaded().progress(function() {
			$container.masonry('layout');
		});
	}

	/* card layout on scrolling with infinite scroll */
	layoutOnScroll($container) {
		jQueryBridget('infiniteScroll', InfiniteScroll, $);
		InfiniteScroll.imagesLoaded = imagesLoaded;
		// get Masonry instance
		let msnry = $container.data('masonry');
		// Infinite Scroll
		$container.infiniteScroll({
			path: gyaanData.nopagination_url + '/page/{{#}}/',
			append: '.card-wrapper',
			outlayer: msnry,
			hideNav: '.pagination-wrapper'
		});
	}

	/* append content to current card layout */
	appendToLayout($container, $content) {
		$container.append($content).masonry('appended', $content);
		this.layoutOnImgLoad($container);
	}
}

export default CardLayout;