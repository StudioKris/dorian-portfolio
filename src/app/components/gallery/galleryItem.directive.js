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
  constructor ($element, $scope) {
    'ngInject';

    // "this.creation" is avaible by directive option "bindToController: true"
    this.mainController = $scope.main;
  }

  openItem() {

  }

  closeItem() {

  }

  hideItem() {

  }
}

export default GalleryItemDirective;
