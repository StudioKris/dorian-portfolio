class MainController {
  constructor ($timeout, toastr, gallery) {
    'ngInject';

    this.galleries = [];
    this.galleries_all_contents = [];
    this.classAnimation = '';
    this.creationDate = 1438525681651;
    this.toastr = toastr;

    this.activate($timeout, gallery);
  }

  getGalleries(gallery) {
    var self = this;
    this.galleries = gallery.getGalleries();
    angular.forEach(this.galleries, function(gallery) {
      self.galleries_all_contents = self.galleries_all_contents.concat(gallery.contents);
    });
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
}

export default MainController;
