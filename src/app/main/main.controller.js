class MainController {
	constructor($timeout, toastr, gallery, $window, $document) {
		'ngInject';

		this.window = $window;
		this.document = $document;

		this.galleries = [];
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

	showToastr() {
		this.toastr.info('Fork <a href="https://github.com/Swiip/generator-gulp-angular" target="_blank"><b>generator-gulp-angular</b></a>');
		this.classAnimation = '';
	}

	openItem($event) {
		$event.stopPropagation();
		this.currentItem = angular.element($event.currentTarget).get(0);



		var sequence = new TimelineLite({
			paused: true
		});

		var otherItems = this._showHideOtherItems();

		sequence.add(otherItems);
		sequence.add(_openItem(), 0);

		sequence.play();

		//this.currentItem.addClass('item-opened');
	}

	_showHideOtherItems() {
		var TL = new TimelineLite;

		var items = this.document.find('.item-container');

		for (var i in items) {

			var item = angular.element(items[i]);

			// When called with `openCard`.
			if (this.currentItem !== item) {
				TL.add(this._hideItem(item), 0);
			}
		}

		return TL;
	}

	_hideItem(element) {

		var tween = TweenLite.to(element, 0.4, {
			scale: 0.8,
			autoAlpha: 0,
			transformOrigin: 'center bottom',
			ease: Expo.easeInOut
		});

		return tween;
	};

	_openItem() {
		var container = this.currentItem.find('.item-container').get(0);
		var clip = this.currentItem.find('.clip').get(0);
		var content = this.currentItem.find('.content').get(0);

		var slideContentDown = this._slideContentDown(content);
		var clipImageIn = this._clipImageIn(clip);
		var floatContainer = this._floatContainer(container);
		var clipImageOut = this._clipImageOut(clip);
		var slideContentUp = this._slideContentUp(content);

		var itemSequence = new TimelineLite();

		itemSequence.add(slideContentDown);
		itemSequence.add(clipImageIn, 0);
		itemSequence.add(floatContainer, '-=' + clipImageIn.duration() * 0.6);
		itemSequence.add(clipImageOut, '-=' + floatContainer.duration() * 0.3);
		itemSequence.add(slideContentUp, '-=' + clipImageOut.duration() * 0.6);

		return itemSequence;
	}

	_slideContentDown(element) {
		var tween = TweenLite.to(element, 0.8, {
			y: this.window.innerHeight,
			ease: Expo.easeInOut
		});

		return tween;
	}

	_clipImageIn(element) {
		var tween = TweenLite.to(element, 0.8, {
			attr: {
				r: 60
			},
			ease: Expo.easeInOut
		});

		return tween;
	}

	_floatContainer(element) {
		this.document.find('body').addClass('body-hidden');

		var TL = new TimelineLite;

		var rect = element.getBoundingClientRect();
		var windowW = this.window.innerWidth;

		TL.set(element, {
			width: rect.width,
			height: rect.height,
			x: rect.left,
			y: rect.top,
			position: 'fixed',
			overflow: 'hidden'
		});

		TL.to(element, 2, {
			width: windowW,
			height: '100%',
			x: windowW / 2,
			y: 0,
			xPercent: -50,
			ease: Expo.easeInOut,
			clearProps: 'all',
			className: '-=' + 'item-container-closed'
		});

		return TL;
	}

	_clipImageOut(element) {
		var radius = $(element).attr('r');

		var tween = this._clipImageIn(element);

		tween.vars.attr.r = radius;

		return tween;
	}

	_slideContentUp(element) {
		var tween = TweenLite.to(element, 1, {
			y: 0,
			clearProps: 'all',
			ease: Expo.easeInOut
		});

		return tween;
	}

	closeItem($event) {
		$event.stopPropagation();
		this.currentItem.removeClass('item-opened');
	}
}

export default MainController;