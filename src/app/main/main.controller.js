class MainController {
	constructor($timeout, toastr, gallery, $window) {
		'ngInject';

		this.window = $window;

		this.galleries = [];
		this.animatedItems = [];

		this.classAnimation = '';
		this.creationDate = 1438525681651;
		this.toastr = toastr;

		this.currentItem = null;

		this.activate($timeout, gallery);
	}

	getGalleries(gallery) {
		this.galleries = gallery.getGalleries();
	}

	activate($timeout, gallery) {
		this.getGalleries(gallery);
		$timeout(() => {
			this.classAnimation = 'rubberBand';
		}, 4000);
	}

	addAnimatedItems(itemController) {
		this.animatedItems.push(itemController);
	}

	showToastr() {
		this.toastr.info('Fork <a href="https://github.com/Swiip/generator-gulp-angular" target="_blank"><b>generator-gulp-angular</b></a>');
		this.classAnimation = '';
	}

	openItem(item) {
		this._toggleItem(item);
	}

	closeItem(item) {
		this._toggleItem(item);
	}

	_toggleItem(item) {
		this.currentItem = item;
		
		var sequence = new TimelineLite({
			paused: true
		});

		var otherItems = this._showHideOtherItems(this.currentItem.isOpen);

		if (this.currentItem.isOpen) {
			sequence.add(otherItems);
			sequence.add(this.currentItem.increaseItem());
		} else {
			sequence.add(this.currentItem.reduceItem());
			sequence.add(otherItems);
		}

		sequence.play();
	}

	_showHideOtherItems(hide) {
		var sequence = new TimelineLite();

		/*var rect = this.currentItem.getBoundingClientRect();
		var midX = rect.left + rect.width / 2;
		var bottom = this.window.innerHeight;*/

		for (var i in this.animatedItems) {
			var item = this.animatedItems[i];

			if (this.currentItem !== item) {
				if(hide) {
					sequence.add(item.hideItem(), '-=0.2');
				}
				else {
					sequence.add(item.showItem(), '-=0.2');
				}
			}
		}

		return sequence;
	}
}

export default MainController;