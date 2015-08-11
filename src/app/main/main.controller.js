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
    this.currentItem = item;
		var sequence = new TimelineLite({
			paused: true
		});

		var otherItems = this._showHideOtherItems();

		sequence.add(otherItems);
		sequence.add(this.currentItem.showItem());

		sequence.play();

		//this.currentItem.addClass('item-opened');
	}

	_showHideOtherItems() {
		var sequence = new TimelineLite();

    var rect = this.currentItem.getBoundingClientRect();
    var midX = rect.left + rect.width / 2;
    var bottom = this.window.innerHeight;

		for (var i in this.animatedItems) {
			var item = this.animatedItems[i];

      

			if (this.currentItem !== item) {
				sequence.add(item.hideItem(), '-=0.2');
			}
		}

		return sequence;
	}

	closeItem($event) {
		$event.stopPropagation();
		this.currentItem.removeClass('item-opened');
	}
}

export default MainController;