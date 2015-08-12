class GalleryItemDirective {
  constructor () {
    'ngInject';

    let directive = {
      restrict: 'E',
      templateUrl: 'app/components/gallery/galleryItem.html',
      scope: {
          content: '='
      },
      controller: GalleryItemController,
      controllerAs: 'vm',
      bindToController: true
    };

    return directive;
  }
}

class GalleryItemController {
  constructor ($element, $scope, $window, $document) {
    'ngInject';

    this.window = $window;
    this.document = $document;

    // "this.creation" is avaible by directive option "bindToController: true"
    this.mainController = $scope.$parent.$parent.main;
    this.element = $element;
    this.uiContainer = this.element.find('.item-container').get(0);
    this.uiClip = this.element.find('.clip').get(0);
    this.uiContent = this.element.find('.content').get(0);

    this.mainController.addAnimatedItems(this);
  }

  openItem($event) {
    $event.stopPropagation();
    this.mainController.openItem(this);
  }

  showItem() {
    var slideContentDown = this._slideContentDown();
    var clipImageIn = this._clipImageIn();
    var floatContainer = this._floatContainer();
    var clipImageOut = this._clipImageOut();
    var slideContentUp = this._slideContentUp();

    var sequence = new TimelineLite();

    sequence.add(slideContentDown);
    sequence.add(clipImageIn, 0);
    sequence.add(floatContainer, '-=' + clipImageIn.duration() * 0.6);
    sequence.add(clipImageOut, '-=' + floatContainer.duration() * 0.3);
    sequence.add(slideContentUp, '-=' + clipImageOut.duration() * 0.6);

    return sequence;
  }

  _slideContentDown() {
    var tween = TweenLite.to(this.uiContent, 0.8, {
      y: this.window.innerHeight,
      ease: Expo.easeInOut
    });

    return tween;
  }

  _clipImageIn() {
    var tween = TweenLite.to(this.uiClip, 0.8, {
      attr: {
        r: 60
      },
      ease: Expo.easeInOut
    });

    return tween;
  }

  _floatContainer() {
    this.document.find('body').addClass('body-hidden');

    var TL = new TimelineLite;

    var rect = this.uiContainer.getBoundingClientRect();
    var windowW = this.window.innerWidth;

    TL.set(this.uiContainer, {
      width: rect.width,
      height: rect.height,
      x: rect.left,
      y: rect.top,
      position: 'fixed',
      overflow: 'hidden',
      'z-index': 1000
    });

    TL.to(this.uiContainer, 2, {
      width: windowW,
      height: '100%',
      x: windowW / 2,
      y: 0,
      xPercent: -50,
      ease: Expo.easeInOut,
      clearProps: 'all',
      className: '-=' + 'item-closed'
    });

    return TL;
  }

  _clipImageOut() {
    var radius = this.uiClip.attributes['r'].value;

    var tween = this._clipImageIn();

    tween.vars.attr.r = radius;

    return tween;
  }

  _slideContentUp() {
    var tween = TweenLite.to(this.uiContent, 1, {
      y: 0,
      clearProps: 'all',
      ease: Expo.easeInOut
    });

    return tween;
  }

  closeItem() {

  }

  hideItem() {
    var tween = TweenLite.to(this.element, 0.4, {
      y: this.window.innerHeight,
      autoAlpha: 0,
      ease: Expo.easeInOut
    });

    return tween;
  }
}

export default GalleryItemDirective;
