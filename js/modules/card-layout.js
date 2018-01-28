/**
* card layout using Masonry
* -------------------------
*/
import jQueryBridget from 'jquery-bridget';
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';

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
			percentPosition: true
		});
		this.layoutOnImgLoad(this.$cardContainer);
	}

	/* when each image is loaded, layout Masonry */
	layoutOnImgLoad($container) {
		imagesLoaded.makeJQueryPlugin($);
		$container.imagesLoaded().progress(function() {
			$container.masonry('layout');
		});
	}

	/* append content to current card layout */
	appendToLayout($container, $content) {
		$container.append($content).masonry('appended', $content);
		this.layoutOnImgLoad($container);
	}
}

export default CardLayout;