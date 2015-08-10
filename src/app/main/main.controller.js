class MainController {
  constructor ($timeout, toastr, gallery) {
    'ngInject';

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
    this.currentItem = angular.element($event.currentTarget);
    this.currentItem.addClass('item-opened');
  }

  closeItem($event) {
    $event.stopPropagation();
    this.currentItem.removeClass('item-opened');
  }
}

export default MainController;
